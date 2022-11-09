<?php

namespace App\Http\Controllers;

use App\Models\Flight;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FlightController extends Controller
{
    //
    public function create(Request $req){
        $flight = Flight::create([
            'username'=>$req->username,
            'email'=>$req->email,
            'flight_id'=>$req->flight_id,
            'fname'=>$req->fname,
            'fdesc'=>$req->desc,
            'fprice'=>$req->fprice,
            'user_id'=>$req->user_id
        ]);
        $flight->save();
        return response()->json([
            'status'=>200,
            'message'=>'Added to the cart',
        ]);
    }
    public function cartCount($id){
        $count = Flight::where('user_id',$id)->get();
        $cart_num = $count->count();
        if($cart_num > 0){
            return response()->json([
                'carts'=>$cart_num,
                'flights'=>$count
            ]);
        }else{
            return;
        }

    }
    public function delete($id){
        $flight1 = Flight::find($id);
        $flight1->delete();
        return response()->json([
            'status'=>200,
            'message'=>'flight removed',
        ]);
    }
}