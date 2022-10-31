<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    // post direct page
    public function adminPost()
    {
       $category = Category::get();
       $posts = Post::get();
       return view('admin.post.index',compact('category','posts'));
    }

    // post create
    public function postCreate(Request $request)
    {
        $this->postDataValidation($request);
        if(!empty($request->postImage)){
            $file = $request->file('postImage');
            $filename = uniqid().'_'.$file->getClientOriginalName();
            $file->move(public_path().'/postImage',$filename);
            $data = $this->getPostData($request,$filename);
        }else{
            $data = $this->getPostData($request,NULL);
        }
        Post::create($data);
        return redirect()->route('admin#post');
    }

    // post delete
    public function postDelete($id)
    {
        $postData = Post::where('post_id',$id)->first();
        $dbImage  = $postData['image'];
        Post::where('post_id',$id)->delete();
        if(File::exists(public_path().'/postImage/'.$dbImage)){
            File::delete(public_path().'/postImage/'.$dbImage);
        }
        return redirect()->route('admin#post');
    }

    // post edit page
    public function postEditPage($id)
    {
        $editPosts = Post::where('post_id',$id)->first();
        $category  = Category::get();
        $posts = Post::get();
        return view('admin.post.update',compact('editPosts','category','posts'));
    }

    // post update
    public function postUpdate($id,Request $request)
    {
       $this->postDataValidation($request);
       $data = $this->getUpdatePostData($request);

    //    if(isset($request->postImage)){

    //     // get update image name from client
    //     $file = $request->file('postImage');
    //     $filename = uniqid().'_'.$file->getClientOriginalName();

    //     // get image name from database
    //     $postData = Post::where('post_id',$id)->first();
    //     $dbImageName = $postData['image'];

    //     if(File::exists(public_path().'/postImage/'.$dbImageName)){
    //         File::delete(public_path().'/postImage/'.$dbImageName);
    //     }
    //    }
       if($request->hasFile('postImage')){
        $oldImage = Post::where('post_id',$id)->first();
        $oldImage = $oldImage['image'];
        if(File::exists(public_path().'/postImage/'.$oldImage)){
            File::delete(public_path().'/postImage/'.$oldImage);
        }
        $filename = uniqid() . $request->file('postImage')->getClientOriginalName();
        $request->file('postImage')->move(public_path().'/postImage',$filename);;
        $data['image'] = $filename;
    }
    Post::where('post_id',$id)->update($data);
    return redirect()->route('admin#post');
    }

    // Update Post Data
    private function getUpdatePostData($request)
    {
        $response = [
            "title" => $request->postTitle,
            "description" => $request->PostDescription,
            "category_id" => $request->postCategory
        ];
        return $response;
    }

    // Post Data
    private function getPostData($request,$filename)
    {
        $response = [
            "title" => $request->postTitle,
            "description" => $request->PostDescription,
            "image" => $filename,
            "category_id" => $request->postCategory
        ];
        return $response;
    }

    // post data validation
    private function postDataValidation($request)
    {
        $message = [
            'postTitle' => 'required',
            'PostDescription' => 'required',
            'postCategory' => 'required'
        ];
        Validator::make($request->all(),$message)->validate();
    }
}
