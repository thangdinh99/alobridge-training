<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Exception;


class LoginController extends Controller
{
    public function login(LoginRequest $request){
        try{
            
            $credentials = request(['email', 'password']);

            if (!Auth::attempt($credentials)){
                return response()->json([
                    'status_code' => 422,
                    'message' => 'Unauthorized',
                    
                ]);
            }

            $user =  User::where('email', $request->email)->first();

            if(!Hash::check($request->password, $user->password, [])){
                return response()->json([
                    'status_code' => 422,
                    'message' => 'Password Not Match',
                    
                ]);
            }

            $tokenResult = $user->createToken('authToken')->plainTextToken;
            return response()->json([
                'status_code' => 200,
                'access_token' => $tokenResult,
                'token_type' => 'Bearer',
            ]);

        }catch(Exception $error){
            return response()->json([
                'status_code' => 500,
                'message' => 'Error in login',
                'error' => $error,
            ]);
        }
    }
}
