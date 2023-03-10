<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\User;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $title = "";
        if (request("category")) {
            $category = Category::firstWhere("category_slug", request("category"));
            $title = " in " . $category->category_name;
        }
        if (request("author")) {
            $author = User::firstWhere("username", request("author"));
            $title = " by " . $author->name;
        }
        return view('posts', [
            "title" => "All Posts" . $title,
            "active" => "posts",
            // "posts" => Post::all()
            "posts" => Post::latest()->filter(request(["search", "category", "author"]))->paginate(7)
        ]);

        // return response()->json(["status" => "success", "data" => $data], 200);
        // return response()->json(["status" => "error", "message" => $data], 400);
        // return true;
    }

    public function show(Post $post)
    {
        return view('post', [
            "title" => "Single Post",
            "active" => "posts",
            "post" => $post
        ]);
    }
}
