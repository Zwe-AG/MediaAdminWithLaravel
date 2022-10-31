<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ListController extends Controller
{
    // admin list
    public function adminList()
    {
        $userData = User::select('id','name','email','phone','address','gender')->get();
        return view('admin.list.index',compact('userData'));
    }

    // admin delete
    public function adminDelete($id)
    {
        User::where('id',$id)->delete();
        return redirect()->route('admin#list')->with(['deleteSuccess'=>'admin အကောင့်ကို ဖျက်လိုက်ပါပြီ။']);
    }

    public function adminListSearch(Request $request)
    {
        $userData = User::orWhere('name','like','%'.$request->Searchkey.'%')
                    ->orWhere('email','like','%'.$request->Searchkey.'%')
                    ->orWhere('phone','like','%'.$request->Searchkey.'%')
                    ->orWhere('address','like','%'.$request->Searchkey.'%')
                    ->orWhere('gender','like','%'.$request->Searchkey.'%')
                    ->get();
        return view('admin.list.index',compact('userData'));
    }
}
