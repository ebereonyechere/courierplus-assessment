<?php

use App\Models\Post;
use App\Models\User;

/**
 * Tests if approved tenants can create new posts
 */
test('tenants can create new posts', function () {
    $user = createApprovedTestUser();

    $data = [
        'title' => 'test title',
        'content' => 'test content'
    ];

    $response = $this->actingAs($user)->post(route('posts.store'), $data);
    $response->assertRedirectToRoute('posts.index');
    $response->assertSessionHasNoErrors();

    $this->assertDatabaseHas('posts', [
        'title' => 'test title',
        'content' => 'test content'
    ]);
});

/**
 * Tests if approved tenants cann view their own posts
 */
test('tenants can view own posts', function () {
    $user = createApprovedTestUser();
    $post = Post::factory()->create(['user_id' => $user->id]);

    $response = $this->actingAs($user)->get(route('posts.show', $post));

    $response->assertSee($post->title);
    $response->assertSee($post->content);
});

/**
 * Tests if approved tenants cannot view other tenants posts
 */
test('tenants cannot view other tenants posts', function () {
    $user = createApprovedTestUser();
    $otherUser = createApprovedTestUser();
    $post = Post::factory()->create(['user_id' => $otherUser->id]);

    $response = $this->actingAs($user)->get(route('posts.show', $post));

    $response->assertStatus(403);
});

/**
 * Tests if admin can view all tenants posts
 */
test('admin can view all tenants posts', function () {
    $admin = User::factory()->create([
        'is_admin' => true,
    ]);

    $user1 = createApprovedTestUser();
    $user2 = createApprovedTestUser();
    $post1 = Post::factory()->create(['user_id' => $user1->id]);
    $post2 = Post::factory()->create(['user_id' => $user2->id]);
    $response = $this->actingAs($admin)->get(route('posts.index'));
    $response->assertSee($post1->title);
    $response->assertSee($post2->title);
});
