<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    // category direct page
    public function adminCategory()
    {
        $categories = Category::get();
        return view('admin.category.index',compact('categories'));
    }

    // category create
    public function categoryCreate(Request $request)
    {
        $this->categoryDataValidation($request);
        $data = $this->categoryData($request);
        Category::create($data);
        return back();
    }

    // category delete
    public function adminCategoryDelete($id)
    {
        Category::where('category_id',$id)->delete();
        return redirect()->route('admin#category')->with(['deleteSuccess' => 'Cateogry ကို ဖျက်လိုက်ပါပြီ။']);
    }

    // category search
    public function categoryListSearch(Request $request)
    {
        $categories = Category::where('title','LIKE','%'.$request->Searchkey.'%')->get();
        return view('admin.category.index',compact('categories'));
    }

    // category edit page
    public function categoryEditPage($id)
    {
        $categories = Category::get();
        $updateCategory = Category::where('category_id',$id)->first();
        return view('admin.category.edit',compact('updateCategory','categories'));
    }

    // category update
    public function categoryUpdate($id,Request $request)
    {
        $this->categoryDataValidation($request);
        $data = $this->categoryData($request);
        Category::where('category_id',$id)->update($data);
        return redirect()->route('admin#category');
    }

    // category data
    private function categoryData($request)
    {
        return [
            'title' => $request->categoryTitle,
            'description' => $request->categoryDescription
        ];
    }

    // category data validation
    private function categoryDataValidation($request)
    {
        $message = [
            'categoryTitle' => 'required',
            'categoryDescription' => 'required',
        ];
        Validator::make($request->all(),$message)->validate();
    }
}
