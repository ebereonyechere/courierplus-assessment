<?php

use App\Models\Post;
use Laravel\Sanctum\Sanctum;

/**
 * Tests if approved tenants can create posts from the api
 */
test('tenants can create posts via the api', function () {
    $data = [
        'title' => 'test title from api',
        'content' => 'test content from api'
    ];

    Sanctum::actingAs(createApprovedTestUser());

    $response = $this->post(route('api.posts.store'), $data);

    $this->assertDatabaseHas('posts', [
        'title' => 'test title from api',
        'content' => 'test content from api'
    ]);
});

/**
 * Tests if approved tenants can view own posts from the api
 */
test('tenants can view own posts via the api', function () {
    $user = createApprovedTestUser();
    Sanctum::actingAs($user);

    $post = Post::factory()->create(['user_id' => $user->id]);
    $response = $this->get(route('api.posts.show', $post));
    $response->assertSee($post->title);
    $response->assertSee($post->content);
    $response->assertStatus(200);
    $response->assertJson([
        'data' => [
            'title' => $post->title,
            'content' => $post->content,
        ]
    ]);
});

/**
 * Tests if approved tenants can view own posts from the api
 */
test("tenants cannot view other tenants posts", function () {
    $user = createApprovedTestUser();
    $otherUser = createApprovedTestUser();
    Sanctum::actingAs($user);

    $post = Post::factory()->create(['user_id' => $otherUser->id]);

    $response = $this->get(route('api.posts.show', $post));
    $response->assertStatus(403);
});
