<?php

use App\Livewire\Pages\Post\CreatePost;
use App\Models\Post;
use App\Models\User;
use Livewire\Livewire;

test('guests cannot access create post component', function () {
    $response = $this->get(route('posts.create'));

    $response->assertRedirect(route('login'));
});

test('authenticated users can access create post component', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->get(route('posts.create'));

    $response->assertSuccessful();
    $response->assertSeeLivewire(CreatePost::class);
});

test('authenticated users can create posts via livewire component', function () {
    $user = User::factory()->create();

    Livewire::actingAs($user)
        ->test(CreatePost::class)
        ->set('title', 'Test Post')
        ->set('excerpt', 'Test excerpt')
        ->set('content', 'Test content')
        ->set('is_published', true)
        ->call('save')
        ->assertRedirect(route('posts.show', Post::where('title', 'Test Post')->first()));

    $this->assertDatabaseHas('posts', [
        'title' => 'Test Post',
        'excerpt' => 'Test excerpt',
        'content' => 'Test content',
        'user_id' => $user->id,
        'is_published' => true,
    ]);
});

test('create post component validates required fields', function () {
    $user = User::factory()->create();

    Livewire::actingAs($user)
        ->test(CreatePost::class)
        ->set('title', '')
        ->set('content', '')
        ->call('save')
        ->assertHasErrors(['title', 'content']);
});

test('create post component validates title max length', function () {
    $user = User::factory()->create();

    Livewire::actingAs($user)
        ->test(CreatePost::class)
        ->set('title', str_repeat('a', 256))
        ->set('content', 'Valid content')
        ->call('save')
        ->assertHasErrors(['title']);
});

test('create post component validates excerpt max length', function () {
    $user = User::factory()->create();

    Livewire::actingAs($user)
        ->test(CreatePost::class)
        ->set('title', 'Valid title')
        ->set('excerpt', str_repeat('a', 501))
        ->set('content', 'Valid content')
        ->call('save')
        ->assertHasErrors(['excerpt']);
});

test('create post component creates draft when not published', function () {
    $user = User::factory()->create();

    Livewire::actingAs($user)
        ->test(CreatePost::class)
        ->set('title', 'Draft Post')
        ->set('content', 'Draft content')
        ->set('is_published', false)
        ->call('save');

    $post = Post::where('title', 'Draft Post')->first();
    expect($post->is_published)->toBeFalse();
    expect($post->published_at)->toBeNull();
});

test('create post component sets published_at when published', function () {
    $user = User::factory()->create();

    Livewire::actingAs($user)
        ->test(CreatePost::class)
        ->set('title', 'Published Post')
        ->set('content', 'Published content')
        ->set('is_published', true)
        ->call('save');

    $post = Post::where('title', 'Published Post')->first();
    expect($post->is_published)->toBeTrue();
    expect($post->published_at)->not->toBeNull();
});

test('create post component generates slug from title', function () {
    $user = User::factory()->create();

    Livewire::actingAs($user)
        ->test(CreatePost::class)
        ->set('title', 'My Awesome Post Title')
        ->set('content', 'Content')
        ->call('save');

    $this->assertDatabaseHas('posts', [
        'title' => 'My Awesome Post Title',
        'slug' => 'my-awesome-post-title',
    ]);
});

test('create post component shows success message after creation', function () {
    $user = User::factory()->create();

    Livewire::actingAs($user)
        ->test(CreatePost::class)
        ->set('title', 'Test Post')
        ->set('content', 'Test content')
        ->call('save')
        ->assertRedirect();

    expect(session('success'))->toBe('Post created successfully.');
});
