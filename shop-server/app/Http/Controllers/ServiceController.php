<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ServiceController extends Controller
{
    //
    public function addService(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'validationErrors' => $validator->messages()
            ]);
        } else {
            $service = Service::create([
                'name' => $req->name,
                'description' => $req->description,
                'price' => $req->price
            ]);
            $service->save();
            return response()->json([
                'status' => 200,
                'message' => 'Service added successfully',
                'service' => $service
            ]);
        }
    }
    public function services(){
        $services = Service::all();
        return response()->json([
            'status'=>200,
            'services'=>$services
        ]);
    }
}