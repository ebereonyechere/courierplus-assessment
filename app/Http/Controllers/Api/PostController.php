<?php

namespace App\Http\Controllers\Api;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return PostResource::collection($request->user()->posts);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {
        $post = $request->user()->posts()->create($request->validated());
        return $post->toResource();
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post, Request $request)
    {
        if ($request->user()->cannot('view', $post)) {
            return response()->json([
                'message' => 'Unauthorized'
            ], 403);
        }
        return $post->toResource();
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        $post->update($request->validated());

        return $post->toResource();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post, Request $request)
    {
        if ($request->user()->cannot('delete', $post)) {
            return response()->json([
                'message' => 'Unauthorized'
            ], 403);
        }

        $post->delete();
        return response()->json([
            'message' => 'Post deleted successfully'
        ], 200);
    }
}
