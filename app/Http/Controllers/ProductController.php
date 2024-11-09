<?php
namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\View\View;

class ProductController extends Controller
{
    function ProductPage(){
        return view('pages.product-page');
    }


    function ProductList()
    {
        return Product::all();
    }

    function CreateProduct(Request $request)
    {
        $img = $request->file('img');
        $t=time();
        $file_name=$img->getClientOriginalName();
        $img_name="{$t}-{$t}-{$file_name}";
        $img_url="uploads/{$img_name}";
        $img->move(public_path('uploads'),$img_name);

        return Product::create([
            'product_id'=>$request->input('product_id'),
            'name'=>$request->input('name'),
            'description'=>$request->input('description'),
            'price'=>$request->input('price'),
            'stock'=>$request->input('stock'),
            'img'=>$img_url
        ]);
    }

    function DeleteProduct(Request $request){
        $filePath=$request->input('file_path');
        File::delete($filePath);
        $productId=  $request->input('product_id');
        return Product::where('product_id',$productId)->delete();
    }

    function EditProduct(Request $request){
        $productId=$request->input('product_id');
        if($request->hasFile('img')){
            $img=$request->file('img');
            $t=time();
            $file_name=$img->getClientOriginalName();
            $img_name="{$t}-{$t}-{$file_name}";
            $img_url="uploads/{$img_name}";
            $img->move(public_path('uploads'),$img_name);

            //delete old image
            $file_path = $request->input('file_path');
            File::delete($file_path);

            return Product::where('product_id',$productId)->update([
                'product_id'=>$request->input('product_id'),
                'name'=>$request->input('name'),
                'description'=>$request->input('description'),
                'price'=>$request->input('price'),
                'stock'=>$request->input('stock'),
                'img'=>$img_url
            ]);
        }
        else{
            return Product::where('product_id',$productId)->update([
                'product_id'=>$request->input('product_id'),
                'name'=>$request->input('name'),
                'description'=>$request->input('description'),
                'price'=>$request->input('price'),
                'stock'=>$request->input('stock'),
            ]);
        }


    }
    function ByProductID(Request $request)
    {
        $product_id=$request->input('product_id');
        return Product::where('product_id',$product_id)->first();
    }

}
