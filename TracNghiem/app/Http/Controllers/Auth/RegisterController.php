<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Http\Requests\RegisterRequest;
use Exception;

class RegisterController extends Controller
{
    public function register(RegisterRequest $request)
    {

        try {
            $request['password'] = $request['password'];
            $request['remember_token'] = Str::random(10);
            $user = User::create($request->toArray());
            return response()->json([
                'status_code' => 200,
                'data'=> $user,
                'message' => 'Registration Successfull',
            ]);
        } catch (Exception $error) {
            return response()->json([
                'status_code' => 500,
                'message' => 'Error in Registration',
                'error' => $error,
            ]);
        }
    }
}
