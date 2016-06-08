<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Storage;
use Validator;
use App\Category;

class CategoriesController extends Controller
{
    public function getCategories(){
        $categories = Category::paginate(3);
        return view('Category.index')->with('categories',$categories);
    }
    
    public function getAddCategory(){
        return view('Category.add');
    }
    
    public function postAddCategory(Request $request) {
        
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:categories',
            'image'=> 'required|mimes:jpeg,jpg,png',
        ]);

        if ($validator->fails()) {
            return redirect()
                        ->back()
                        ->withErrors($validator);
        }
        
        $data_input = $request->all();
        if ($request->file('image')->isValid()) {
            $file = $request->file('image');
            $file_name = $data_input['name'] . '.jpg';
            $path = "uploads/" . Auth::user()->username.'/category';
            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }
            $data_input['image'] = $path . '/' . $file_name;
            $file->move($path, $file_name);
        }
        if (Category::create($data_input)) {
            return redirect('category')->withErrors('Your register Category done!');
        } else {
            return redirect()->back();
        }
    }
    
    public function getUpdateCategory($id = null) {
        $category = Category::where('id',$id)->first();
        return view('Category.update')->with('category', $category);
    }

    public function postUpdateCategory(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'image'=> 'mimes:jpeg,jpg,png',
        ]);
        
        
        $id = $request->id;
        $name = Category::where('id','!=',$id)->where('name',$request->name)->get();
        if($name->count()){
            return redirect()->back()->withErrors(
                            'Name has been use. Please chose diffrent name!');
        }

        if ($validator->fails()) {
            return redirect()
                        ->back()
                        ->withErrors($validator);
        }
        
        $image = '';
        if (!empty($request->file('image')) && $request->file('image')->isValid()) {
            $file = $request->file('image');
            $file_name = $request->name . '.jpg';
            $path = "uploads/" . Auth::user()->username.'/category';
            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }
            $image = $path . '/' . $file_name;
            $file->move($path, $file_name);
        }
        if ($image == '') {
            $results = Category::where('id', $request->id)->update([
                'name' => $request->name,
                'note' => $request->note,
            ]);
        } else {
            $results = Category::where('id', $request->id)->update([
                'name' => $request->name,
                'note' => $request->note,
                'image' => $image,
            ]);
        }
//            dump($results);
//            exit(0);
        if ($results > 0) {
            return redirect('category')->withErrors(
                            'Your update Category done!');
        } else {
            return redirect()->back()->withErrors(
                            'Your update Category not done. Please check again!');
        }
    }
    
    public function getDeleteCategory($id = null){
        if (!isset($id) || $id == "") {
            return redirect()->back();
        } else {
            $category = Category::where('id', $id)->first();
            Storage::delete(public_path($category->image));
//            @unlink($category->image);
            if (Category::where('id', $id)->delete()) {
                return redirect('category');
            } else {
                return redirect()->back();
            }
        }
    }
}
