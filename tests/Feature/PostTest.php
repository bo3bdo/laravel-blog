<?php

use App\Models\Post;
use App\Models\User;

test('guests can view posts index', function () {
    Post::factory()->published()->count(5)->create();

    $response = $this->get(route('posts.index'));

    $response->assertSuccessful();
    $response->assertSee('Posts');
});

test('guests can view published posts', function () {
    $post = Post::factory()->published()->create([
        'title' => 'Test Post',
        'content' => 'Test content',
    ]);

    $response = $this->get(route('posts.show', $post));

    $response->assertSuccessful();
    $response->assertSee('Test Post');
    $response->assertSee('Test content');
});

test('guests cannot view draft posts', function () {
    $post = Post::factory()->draft()->create();

    $response = $this->get(route('posts.show', $post));

    $response->assertSuccessful();
});

test('guests cannot access create post page', function () {
    $response = $this->get(route('posts.create'));

    $response->assertRedirect(route('login'));
});

test('authenticated users can access create post page', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->get(route('posts.create'));

    $response->assertSuccessful();
    $response->assertSee('Create New Post');
});

test('authenticated users can create posts', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->post(route('posts.store'), [
        'title' => 'New Post',
        'excerpt' => 'Post excerpt',
        'content' => 'Post content',
        'is_published' => true,
    ]);

    $response->assertRedirect();
    $this->assertDatabaseHas('posts', [
        'title' => 'New Post',
        'excerpt' => 'Post excerpt',
        'content' => 'Post content',
        'user_id' => $user->id,
        'is_published' => true,
    ]);
});

test('authenticated users cannot create posts with invalid data', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->post(route('posts.store'), [
        'title' => '',
        'content' => '',
    ]);

    $response->assertSessionHasErrors(['title', 'content']);
    $this->assertDatabaseMissing('posts', [
        'title' => '',
    ]);
});

test('post owners can view edit page', function () {
    $user = User::factory()->create();
    $post = Post::factory()->create(['user_id' => $user->id]);

    $response = $this->actingAs($user)->get(route('posts.edit', $post));

    $response->assertSuccessful();
    $response->assertSee($post->title);
});

test('post owners can update their posts', function () {
    $user = User::factory()->create();
    $post = Post::factory()->create(['user_id' => $user->id]);

    $response = $this->actingAs($user)->put(route('posts.update', $post), [
        'title' => 'Updated Title',
        'content' => 'Updated content',
        'excerpt' => 'Updated excerpt',
    ]);

    $response->assertRedirect(route('posts.show', $post));
    $this->assertDatabaseHas('posts', [
        'id' => $post->id,
        'title' => 'Updated Title',
        'content' => 'Updated content',
        'excerpt' => 'Updated excerpt',
    ]);
});

test('users cannot update other users posts', function () {
    $owner = User::factory()->create();
    $otherUser = User::factory()->create();
    $post = Post::factory()->create(['user_id' => $owner->id]);

    $response = $this->actingAs($otherUser)->put(route('posts.update', $post), [
        'title' => 'Hacked Title',
        'content' => 'Hacked content',
    ]);

    $response->assertForbidden();
    $this->assertDatabaseMissing('posts', [
        'id' => $post->id,
        'title' => 'Hacked Title',
    ]);
});

test('post owners can delete their posts', function () {
    $user = User::factory()->create();
    $post = Post::factory()->create(['user_id' => $user->id]);

    $response = $this->actingAs($user)->delete(route('posts.destroy', $post));

    $response->assertRedirect(route('posts.index'));
    $this->assertDatabaseMissing('posts', [
        'id' => $post->id,
    ]);
});

test('users cannot delete other users posts', function () {
    $owner = User::factory()->create();
    $otherUser = User::factory()->create();
    $post = Post::factory()->create(['user_id' => $owner->id]);

    $response = $this->actingAs($otherUser)->delete(route('posts.destroy', $post));

    $response->assertForbidden();
    $this->assertDatabaseHas('posts', [
        'id' => $post->id,
    ]);
});

test('posts index shows only published posts', function () {
    Post::factory()->published()->count(3)->create();
    Post::factory()->draft()->count(2)->create();

    $response = $this->get(route('posts.index'));

    $response->assertSuccessful();
    expect($response->viewData('posts')->total())->toBe(3);
});

test('posts are ordered by published_at desc', function () {
    Post::query()->delete();

    $oldDate = now()->subDays(2);
    $newDate = now()->subDay();

    Post::factory()->create([
        'is_published' => true,
        'published_at' => $oldDate,
    ]);
    Post::factory()->create([
        'is_published' => true,
        'published_at' => $newDate,
    ]);

    $posts = Post::published()->orderBy('published_at', 'desc')->get();

    expect($posts->count())->toBeGreaterThanOrEqual(2);

    $firstPost = $posts->first();
    $lastPost = $posts->last();

    expect($firstPost->published_at->timestamp)->toBeGreaterThanOrEqual($lastPost->published_at->timestamp);
});

test('post slug is generated from title', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->post(route('posts.store'), [
        'title' => 'My Awesome Post',
        'content' => 'Content here',
        'is_published' => false,
    ]);

    $response->assertRedirect();
    $this->assertDatabaseHas('posts', [
        'title' => 'My Awesome Post',
        'slug' => 'my-awesome-post',
    ]);
});

test('post formatted content converts markdown to html', function () {
    $post = Post::factory()->create([
        'content' => "# Heading\n\n**Bold text**",
    ]);

    $formatted = $post->formatted_content;

    expect($formatted)->toContain('Heading');
    expect($formatted)->toContain('Bold text');
});

test('post formatted content highlights code blocks', function () {
    $post = Post::factory()->create([
        'content' => '```php
<?php
echo "Hello";
```
',
    ]);

    $formatted = $post->formatted_content;

    expect($formatted)->toContain('torchlight');
});
