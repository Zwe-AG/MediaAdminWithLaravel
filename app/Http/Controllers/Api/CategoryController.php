<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //Category
    public function getAllCategory(Request $request)
    {
        $category = Category::select('category_id','title','description')->get();
        return response()->json([
            'category' => $category
        ]);
    }

    // Category Search
    public function categorySearch(Request $request)
    {
        $post = Post::where('title','LIKE','%'.$request->key.'%')->get();
        return response()->json([
            'searchData' => $post
        ]);
    }

    // Category Choose
    public function categoryChoose(Request $request)
    {
        $category = Category::select('posts.*')
                    ->join('posts','posts.category_id','categories.category_id')
                    ->where('categories.title','like','%'.$request->key.'%')
                    ->get();
        return response()->json([
            'resultData' => $category
        ]);
    }
}
