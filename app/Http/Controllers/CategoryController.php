<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function  addCategory(Request $request){

        if($request->isMethod('post')){
            $data=$request->all();
            $category=new Category;
            $category->name=$data['category-name'];
            $category->description=$data['description'];
            $category->url=$data['url'];
            $category->parent_id=$data['parent_id'];
            $category->save();
            return redirect('/admin/add-category')->with('flash_message_success','Новая категория успешно создана');
        }


        $levels=Category::where(['parent_id'=>0])->get();
        return view('admin.categories.addCategory',compact('levels'));
    }


public function viewCategory(){
        $categories=Category::get();

        return view('admin.categories.viewCategories',compact('categories'));

}

public  function  editCategory(Request $request , $id){
        if($request->isMethod('post')){
$data=$request->all();

Category::where(['id'=>$id])->update(['name'=>$data['category-name'],'description'=>$data['description'],'url'=>$data['url'],'parent_id'=>$data['parent_id']]);

            return redirect('/admin/view-category')->with('flash_message_success','Данные успешно обнавлены');
        }
        $categoryDetails=Category::where(['id'=>$id])->first();

    $levels=Category::all();
        return view('admin.categories.editCategory',compact(['categoryDetails','levels']));

}

public  function deleteCategory($id){

        if(!empty($id)){

            Category::where(['id'=>$id])->delete();
            return redirect()->back()->with('flash_message_success','Категория была удалена');
        }


}



}
