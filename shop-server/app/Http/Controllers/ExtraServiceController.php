<?php

namespace App\Http\Controllers;

use App\Models\ExtraService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ExtraServiceController extends Controller
{
    //
    public function addEtraService(Request $req)
    {

            $service = ExtraService::create([
                'user_id'=>$req->user_id,
                'username'=>$req->username,
                'email'=>$req->email,
                'Sname' => $req->name,
                'Sdesc' => $req->description,
                'Sprice' => $req->price
            ]);
            $service->save();
            return response()->json([
                'status' => 200,
                'message' => 'Service added to cart',
            ]);

    }
    public function ExtraServices($id){
        $extra = ExtraService::where('user_id',$id)->get();

            return response()->json([
                'status'=>200,
                'extra'=>$extra
            ]);


    }
    public function delete($id){
        $extra = ExtraService::find($id);
        $extra->delete();
            return response()->json([
                'status'=>200,
                'message'=>'Removed from the cart!!'
            ]);


    }
}