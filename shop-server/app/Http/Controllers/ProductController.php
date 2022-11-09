<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function addProduct(Request $req){
        $validator = Validator::make($req->all(), [
            'name' => 'required|max:25|min:3',
            'file' => 'max:2000|mimes:jpeg,png,pdf,webp',
            'description' => 'required',
            'quantity' => 'required|numeric|',
            'price' => 'required|numeric',
        ]);
        if($validator->fails()){
             return response()->json([
                'validationErrors'=>$validator->messages()
             ]);
        }else{
        $product =new Product;
        $product->name = $req->input('name');
        $product->file_path = $req->file('file')->store('products');
        $product->description = $req->input('description');
        $product->quantity = $req->input('quantity');
        $product->price = $req->input('price');
        $product->save();

        return response()->json([
            'status'=>200,
            'product'=>$product,
            'message'=>'Product added successfully'
        ]);
        }
    }
    public function productList (){
       $products = Product::all();
       return $products;
    }
    public function delete ($id){
        $product = Product::find($id);
        $product->delete();
        return response()->json([
            'status'=>200,
            'message'=>'data deleted successfully'
        ]);
     }
    public function show($id){
        $product = Product::where('id',$id)->get();
        return response()->json([
            'status'=>200,
            'product'=>$product,
            'message'=>'Product fetched successfully'
        ]);
     }

}