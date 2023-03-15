<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class PostController extends Controller
{
    public function index(): Response
    {
        $posts = Post::all();

        return Inertia::render('Admin/Posts/PostIndex', [
            'posts' => PostResource::collection($posts)
        ]);
    }
}
