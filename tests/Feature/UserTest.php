<?php

use App\Models\Post;
use App\Models\User;

/**
 * Tests if tenants can successfully register on the web
 */
test('tenants can register via /register route', function () {
    $data = [
        'name' => 'Test User',
        'email' => 'testuser@example.com',
        'password' => 'password', // Plaintext for input
        'password_confirmation' => 'password',
    ];

    $response = $this->post(route('users.store'), $data);

    $response->assertRedirectToRoute('login');

    $this->assertDatabaseHas('users', [
        'email' => 'testuser@example.com',
    ]);
});

/**
 * Tests if tenants can successfully login on the web
 */
test('tenants can login via /login route', function () {
    User::factory()->create([
        'email' => 'testuser@example.com',
        'password' => bcrypt('password'),
    ]);

    $data = [
        'email' => 'testuser@example.com',
        'password' => 'password',
    ];

    $response = $this->post(route('sessions.store'), $data);

    $response->assertRedirectToRoute('posts.index');

    $this->assertAuthenticated();
});

/**
 * Tests if tenants cannot perform crud operations until approved
 */
test('tenants cannot perform actions until approved', function () {
    $user = User::factory()->create();
    $post = Post::factory()->create(['user_id' => $user->id]);

    $this->actingAs($user)->get(route('posts.index'))->assertRedirectToRoute('pending');
    $this->actingAs($user)->get(route('posts.create'))->assertRedirectToRoute('pending');
    $this->actingAs($user)->post(route('posts.store'), [
        'title' => 'Test Title',
        'content' => 'Test Content',
    ])->assertRedirectToRoute('pending');
    $this->actingAs($user)->get(route('posts.show', $post->id))->assertRedirectToRoute('pending');
    $this->actingAs($user)->get(route('posts.edit', $post->id))->assertRedirectToRoute('pending');
    $this->actingAs($user)->put(route('posts.update', $post->id), [
        'title' => 'Updated Title',
        'content' => 'Updated Content',
    ])->assertRedirectToRoute('pending');
    $this->actingAs($user)->delete(route('posts.destroy', $post->id))->assertRedirectToRoute('pending');
});

/**
 * Tests if tenants can perform actions after approval
 */
test('tenants can perfrom actons after approval', function () {
    $user = createApprovedTestUser();

    $response = $this->actingAs($user)->get(route('posts.create'));
    $response->assertSee("Create a New Post");
});
