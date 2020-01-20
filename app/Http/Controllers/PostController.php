<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreAttachmentRequest;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $posts = Post:: with([
            'comments', 'categories', 'user', 'comments.user'
        ])
            ->sortByDate()
            ->get();
        return response()->json([
            'posts'  => $posts
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
   
    public function store(StoreAttachmentRequest $request)
    {
        $post = new Post;
        $post->photo = $post->upload($request->attachment);
        $post->title = $request->title;
        $post->text = $request->text;
        $post->user_id = $request->user_id;
        $post->category_id = $request->category_id;
        $post->save();

        return response()->json([
            'post'  => $post
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post:: with(['comments', 'categories', 'user', 'comments.user'])
            ->findOrFail($id);
        $userId = Auth::id();
        $user = Auth::user();

        return response()->json([
            'post'  => $post,
            'userId' => $userId,
            'user' => $user
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        if ($post->delete()) {
        return response()->json([
            'message'  => "The post with id $post->id has successfully been deleted!"
            ], 202);
        }
        return response()->json([
            'message' => "The post with id $post->id wasn't been deleted!"
            ], 400);
    }

}