<?php

namespace App\Http\Controllers\Api;

use Log;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;



class AuthController extends Controller
{
    public function register(Request $request){
        $request->validate(
            [
                'name'=>'required',
                'email'=>'required|email',
                'password'=>'required|min:8|max:12',
                'phone'=>'required'
            ]
        );
        $user=new User();
        $user->name=$request->name;
        $user->email=$request->email;
        $user->phone=$request->phone;
        $user->password = bcrypt($request->password);
        $user->save();
        $token =$user->createToken('laravel9');
        return response()->json([
            'status'=>200,
            'message'=>'Successfully Login',
            'token'=>$token->plainTextToken
        ]);
        
    }

    public function login(Request $request){
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
          //  $token = $user->createToken('laravel9')->accessToken;
    
            return response()->json([
                'status' => 200,
                'message' => 'Successfully Login',
               // 'token' => $token,
            ]);
        }
        
        return response()->json(['status' => 401, 'message' => 'Unauthorized']);
    }
}

?>