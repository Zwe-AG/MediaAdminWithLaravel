<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\ActionLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TrendPostController extends Controller
{
    // trend post direct
    public function adminTrendPost()
    {
        $trendPosts = ActionLog::select('action_logs.*','posts.*',DB::raw('COUNT(action_logs.post_id) as post_count'))
                ->leftJoin('posts','posts.post_id','action_logs.post_id')
                ->groupBy('action_logs.post_id')
                ->get();
        return view('admin.trendpost.index',compact('trendPosts'));
    }

    // trend post detail
    public function trendPostDetail($id)
    {
        $posts = Post::where('post_id',$id)->first();
        return view('admin.trendpost.detail',compact('posts'));
    }
}
