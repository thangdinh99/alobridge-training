<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{

    public function getAllUser(Request $request) : JsonResponse
    {
        $user = User::all();
        return response()->json([
            'status_code' => 200,
            'data' => $user,
        ]);
    }
}
