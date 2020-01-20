<?php

namespace App\Http\Controllers;

use App\Post;
use App\User;
use App\Comment;
use App\Message;
use App\Category;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        $users = User::all()->count();
        $categories = Category::all()->count();
        $posts = Post::all()->count();
        $comments = Comment::all()->count();
        $messages = Message::all()->count();
        $admin = User::where('role', 'admin')->get()->count();
        return response()->json(compact('users', 'categories', 'posts', 'comments', 'messages', 'admin'), 200);
    }
}
