<?php

namespace App\Http\Controllers\Api;

use App\Models\Post;
use App\Models\ActionLog;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ActionLogController extends Controller
{
    //Action Log
    public function setActionLog(Request $request)
    {
        $data = [
            'user_id' => $request->user_id,
            'post_id' => $request->post_id
        ];
        ActionLog::create($data);
        $getData = ActionLog::where('post_id',$request->post_id)->get();
        return response()->json([
            'message' => 'Action Log success',
            'postData' => $getData
        ]);
    }
}
