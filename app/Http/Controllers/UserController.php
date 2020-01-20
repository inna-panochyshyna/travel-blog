<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return response()->json([
            'users'  => $users
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User:: with(['comments', 'comments.post', 'posts.categories', 'posts'])
            ->findOrFail($id);
        return response()->json(compact('user'), 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        if ($user->delete()) {
        return response()->json([
            'message'  => "The user with id $user->id has successfully been deleted!"
            ], 202);
        }
        return response()->json([
            'message' => "The user with id $user->id wasn't been deleted!"
            ], 400);
    }

    public function activity($id)
    {
        $user = User:: with(['comments', 'posts'])
            ->findOrFail($id);
        $countPosts = $user->posts->count();
        $lastPost = $user->posts->first();
        $countComments = $user->comments->count();
        $lastComment = $user->comments->first();
        return response()->json(compact('countPosts', 'countComments', 'lastPost', 'lastComment'), 200);
    }

    public function setRole(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $role = $request->role;
        $user->role = $role;
        if ($user->save()) {
            return response()->json([
            'user'  => $user
            ], 201);
        }
        return response()->json([
            'message' => "The role of user with id $user->id wasn't been updated!"
            ], 400);
    }
}