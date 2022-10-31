<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    // post
    public function getAllPost(Request $request)
    {
        $post  = Post::get();
        return response()->json([
            'status' => 'true',
            'post' => $post
        ]);

    }

    // post detail
    public function postDetail(Request $request)
    {
        $id = $request->postId;
        $post  = Post::where('post_id',$id)->first();
        return response()->json([
            'status' => 'true',
            'post' => $post
        ]);
    }
}
