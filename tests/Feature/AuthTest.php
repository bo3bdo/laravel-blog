<?php

use App\Models\User;
use Illuminate\Support\Facades\Hash;

test('users can view login form', function () {
    $response = $this->get(route('login'));

    $response->assertSuccessful();
    $response->assertSee('Login');
    $response->assertSee('Email');
    $response->assertSee('Password');
});

test('users can view register form', function () {
    $response = $this->get(route('register'));

    $response->assertSuccessful();
    $response->assertSee('Register');
    $response->assertSee('Name');
    $response->assertSee('Email');
    $response->assertSee('Password');
});

test('users can register', function () {
    $response = $this->post(route('register'), [
        'name' => 'John Doe',
        'email' => 'john@example.com',
        'password' => 'password',
        'password_confirmation' => 'password',
    ]);

    $response->assertRedirect(route('posts.index'));
    $this->assertAuthenticated();
    $this->assertDatabaseHas('users', [
        'email' => 'john@example.com',
        'name' => 'John Doe',
    ]);
});

test('users cannot register with invalid data', function () {
    $response = $this->post(route('register'), [
        'name' => '',
        'email' => 'invalid-email',
        'password' => 'short',
        'password_confirmation' => 'different',
    ]);

    $response->assertSessionHasErrors(['name', 'email', 'password']);
    $this->assertGuest();
});

test('users cannot register with duplicate email', function () {
    User::factory()->create(['email' => 'john@example.com']);

    $response = $this->post(route('register'), [
        'name' => 'John Doe',
        'email' => 'john@example.com',
        'password' => 'password',
        'password_confirmation' => 'password',
    ]);

    $response->assertSessionHasErrors(['email']);
    $this->assertGuest();
});

test('users can login with valid credentials', function () {
    $user = User::factory()->create([
        'email' => 'john@example.com',
        'password' => Hash::make('password'),
    ]);

    $response = $this->post(route('login'), [
        'email' => 'john@example.com',
        'password' => 'password',
    ]);

    $response->assertRedirect(route('posts.index'));
    $this->assertAuthenticatedAs($user);
});

test('users cannot login with invalid credentials', function () {
    User::factory()->create([
        'email' => 'john@example.com',
        'password' => Hash::make('password'),
    ]);

    $response = $this->post(route('login'), [
        'email' => 'john@example.com',
        'password' => 'wrong-password',
    ]);

    $response->assertSessionHasErrors(['email']);
    $this->assertGuest();
});

test('users cannot login with non-existent email', function () {
    $response = $this->post(route('login'), [
        'email' => 'nonexistent@example.com',
        'password' => 'password',
    ]);

    $response->assertSessionHasErrors(['email']);
    $this->assertGuest();
});

test('users can login with remember me', function () {
    $user = User::factory()->create([
        'email' => 'john@example.com',
        'password' => Hash::make('password'),
    ]);

    $response = $this->post(route('login'), [
        'email' => 'john@example.com',
        'password' => 'password',
        'remember' => true,
    ]);

    $response->assertRedirect();
    $this->assertAuthenticatedAs($user);
});

test('authenticated users can logout', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->post(route('logout'));

    $response->assertRedirect(route('posts.index'));
    $this->assertGuest();
});

test('guests cannot access logout', function () {
    $response = $this->post(route('logout'));

    $response->assertRedirect(route('login'));
});

test('authenticated users are redirected from login page', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->get(route('login'));

    $response->assertRedirect();
});

test('authenticated users are redirected from register page', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->get(route('register'));

    $response->assertRedirect();
});
