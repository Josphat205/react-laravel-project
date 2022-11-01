<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'email' => 'required|email',
            'password' => 'required|min:8'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'validationErrors' => $validator->messages()
            ]);
        } else {
            $user = User::where('email', $req->email)->first();

            if (!$user || !Hash::check($req->password, $user->password)) {
                return response()->json([
                    'status' => 401,
                    'errors' => 'The provided credentials are incorrect.',
                ]);
            } else {
                $token =  $user->createToken($user->email . '_token')->plainTextToken;
                if($user->is_admin === 1){
                    return response()->json([
                        'status' =>200,
                        'is_admin'=>true,
                        'username'=>$user->name,
                        'token'=>$token,
                        'message'=>'Admin Logged in Successfully!!'
                    ]);
                }else{
                return response()->json([
                    'status' => 200,
                    'is_admin'=>false,
                    'token' => $token,
                    'username' => $user->email,
                    'message' => 'User Logged in Successfully!!'
                ]);
            }
            }
        }
    }
    //registration function
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|',
            'email' => 'required|email|unique:users|max:191',
            'password' => 'required|min:8|'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'validationErrors' => $validator->messages(),
            ]);
        } else {
            $user = User::create([
                'name' => $request['name'],
                'email' => $request['email'],
                'password' => Hash::make($request['password']),
            ]);
            $user->save();
            $token = $user->createToken($user->email . '_Token')->plainTextToken;

            return response()->json([
                'status' => 200,
                'username' => $user->email,
                'token' => $token,
                'message' => 'User Registered Successfully!!'
            ]);
        };
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json([
            'status' => 200,
            'message' => 'User Logged out Successfully!!'
        ]);
    }
}
