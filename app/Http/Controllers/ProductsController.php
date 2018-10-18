<?php

namespace App\Http\Controllers;

use App\Category;
use App\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Image;
class ProductsController extends Controller
{
    public  function  addProduct(Request  $request)
    {
        if ($request->isMethod('post')) {
          $data=$request->all();
          $product= new Products();
         //  print_r($data);die;
               $product->product_name=$data['product_name'];
            $product->description=$data['description'];
            $product->product_code=$data['code'];
            $product->product_color=$data['color'];
            $product->price=$data['price'];

            if($request->hasFile('avatar_img')){
             $img_tmp=Input::file('avatar_img');
             if($img_tmp->isValid()){
                 $extension=$img_tmp->getClientOriginalExtension();
                 $filename=rand(111,999).'.'.$extension;
                 $larg_img_path='img/products/large/'.$filename;
                 $medium_img_path='img/products/medium/'.$filename;
                 $small_img_path='img/products/small/'.$filename;

                 Image::make($img_tmp)->save($larg_img_path);
                 Image::make($img_tmp)->resize(600,600)->save($medium_img_path);
                 Image::make($img_tmp)->resize(300,300)->save($small_img_path);
                 $product->img=$filename;
             }
           }
           else{
               echo "bad";die;
           }
           if(!empty($data['category_id'])){

                $product->category_id=$data['category_id'];

            }
            else{
                return redirect()->back()->with('flash_message_error',' Не выбрана подкатегория товара');

            }


            $product->save();

            return redirect()->back()->with('flash_message_success', 'Продукт добавлен в базу' );


        }
        $categories = Category::where(['parent_id' => 0])->get();
        $categories_dropsown = "<option selected disabled value=''>Выберите категорию товара</option>";
        foreach ($categories as $cat) {
            $categories_dropsown .= "<option value'" . $cat->id . "'>" . $cat->name . "</option>";
            $sub_catigiries = Category::where(["parent_id" => $cat->id])->get();
            foreach ($sub_catigiries as $sub_cat){

                $categories_dropsown .= "<option value='" . $sub_cat->id . "'>&nbsp;--&nbsp;" .
                    $sub_cat->name . "</option>";
        }
    }

        return view("admin.products.addProduct",compact("categories_dropsown"));


    }


    public  function  viewProduct(){

        $products=Products::all();

        $products=json_decode(json_encode($products));
        foreach ($products as $key=>$val)
        {

            $category_name=Category::where(['id'=>$val->category_id])->first();

if(empty($category_name->name)){
    $products[$key]->category_name= "Категория не установлена";
}else{

    $products[$key]->category_name=$category_name->name;
}


        }


        return view("admin.products.viewProduct",compact("products"));


    }


 public function  editProduct(Request $request,$id){
     $data=$request->all();
        if($request->isMethod('post')){

            if (empty($data['category_id'])){

                return redirect()->back()->with('flash_message_error','Не выбрана категория для товара!');
            }


                   /*******
                    for upload_img
                   ********/

                   $filename_img="";
            if($request->hasFile('avatar_img')){
                $img_tmp=Input::file('avatar_img');
                if($img_tmp->isValid()){
                    $extension=$img_tmp->getClientOriginalExtension();
                    $filename=rand(111,999).'.'.$extension;
                    $larg_img_path='img/products/large/'.$filename;
                    $medium_img_path='img/products/medium/'.$filename;
                    $small_img_path='img/products/small/'.$filename;

                    Image::make($img_tmp)->save($larg_img_path);
                    Image::make($img_tmp)->resize(600,600)->save($medium_img_path);
                    Image::make($img_tmp)->resize(300,300)->save($small_img_path);
                    $filename_img=$filename;

                   if(file_exists('img/products/large/'.$data['current_img'])){

                       unlink (public_path('img/products/medium/'.$data['current_img']));
                       unlink (public_path('img/products/large/'.$data['current_img']));
                       unlink (public_path('img/products/small/'.$data['current_img']));
                   }






                }
            }
            else{

                $filename_img=$data['current_img'];
            }



            Products::where('id',$id)->update(['category_id'=>$data['category_id'],'img'=>$filename_img,'product_name'=>$data['product_name'],'description'=>$data['description'],
                'price'=>$data['price'], 'product_color'=>$data['color']]);




            return redirect()->back()->with('flash_message_success','Изменения сохранены');

        }

        $product=Products::where(['id'=>$id])->first();
$categories=Category::where('parent_id','<>','0')->get();

     $categories_current=Category::where('id',$product->category_id)->first();//выборка имени текущей категории
     return view('admin.products.editProduct',compact(['product','categories','categories_current']));


 }

    public  function deleteProduct($id){

        if(!empty($id)){

            Products::where(['id'=>$id])->delete();
            return redirect()->back()->with('flash_message_success','Товар  был успешно удален');
        }

    }


    /*      Attribute function     */

    public  function  addAttributes(Request $request,$data){

        return view("admin.products.addAttribute");

    }

}
