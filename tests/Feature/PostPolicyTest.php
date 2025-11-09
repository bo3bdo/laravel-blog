<?php

use App\Models\Post;
use App\Models\User;

test('anyone can view any post', function () {
    $user = User::factory()->create();
    $post = Post::factory()->create();

    expect($user->can('view', $post))->toBeTrue();
});

test('anyone can view any posts list', function () {
    $user = User::factory()->create();

    expect($user->can('viewAny', Post::class))->toBeTrue();
});

test('authenticated users can create posts', function () {
    $user = User::factory()->create();

    expect($user->can('create', Post::class))->toBeTrue();
});

test('post owners can update their posts', function () {
    $user = User::factory()->create();
    $post = Post::factory()->create(['user_id' => $user->id]);

    expect($user->can('update', $post))->toBeTrue();
});

test('users cannot update other users posts', function () {
    $owner = User::factory()->create();
    $otherUser = User::factory()->create();
    $post = Post::factory()->create(['user_id' => $owner->id]);

    expect($otherUser->can('update', $post))->toBeFalse();
});

test('post owners can delete their posts', function () {
    $user = User::factory()->create();
    $post = Post::factory()->create(['user_id' => $user->id]);

    expect($user->can('delete', $post))->toBeTrue();
});

test('users cannot delete other users posts', function () {
    $owner = User::factory()->create();
    $otherUser = User::factory()->create();
    $post = Post::factory()->create(['user_id' => $owner->id]);

    expect($otherUser->can('delete', $post))->toBeFalse();
});
