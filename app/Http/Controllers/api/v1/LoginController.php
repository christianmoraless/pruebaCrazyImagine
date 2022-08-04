<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class LoginController extends Controller
{
    public function login(Request $request){

        $login = $request->validate([
            'email'=>'required|string',
            'password'=>'required|string',
        ]);

        if(!Auth::attempt($login)){
            return response([
                'message'=>'Invalid login credentials',
                'success'=>false
            ]);
        }
        $user=auth()->user();
        $accessToken =$user->createToken('authToken')->accessToken;
        return response([
            'user' => Auth::user(),
            'access_token' => $accessToken]);

    }

    public function register(Request $request){
        try {
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->save();
            $success = true;
            $message = 'User Register Succesfully';
        } catch (\Throwable $th) {
            $success = false;
            $message = $th->getMessage();
        }
        $response = [
            'success' => $success,
            'message' => $message
        ];
        return response()->json($response);
    }

    public function logout(Request $request){
        if ($request->user()) { 
            $request->user()->tokens()->delete();
        }
        return response()->json(['message' => 'Se elimino'], 200);
    }
}
