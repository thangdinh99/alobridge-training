<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use App\Http\Traits\ResponseTrait;
use Exception;
use Illuminate\Http\JsonResponse;

class AuthController extends Controller
{
    use ResponseTrait;
    public function register(RegisterRequest $request) : JsonResponse
    {

        try {
            $request['password'] = $request['password'];
            $request['remember_token'] = Str::random(10);
            $user = User::create($request->toArray());
            return $this->responseData(200, 'User created successfully', $user);
        } catch (Exception $error) {
            return $this->responseError(500, 'Internal Server Error', $error);
        }
    }

    public function login(LoginRequest $request) : JsonResponse
    {
        try {

            $credentials = request(['email', 'password']);
            if (!Auth::attempt($credentials)) {
                return $this->responseError(422, 'Unauthorized', 'Invalid credentials');
            }
            
            $user =  User::where('email', $request->email)->first();


            $tokenResult = $user->createToken('authToken')->plainTextToken;
            return response()->json([
                'status_code' => 200,
                'access_token' => $tokenResult,
                'token_type' => 'Bearer',
            ]);
        } catch (Exception $error) {
            return $this->responseError(500, 'Internal Server Error', $error);
        }
    }

    public function logout(Request $request) : JsonResponse
    {
        $request->user()->tokens()->delete();
        return $this->responseMessage(200, 'User logged out successfully');
    }
}
