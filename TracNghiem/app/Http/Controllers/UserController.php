<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UserController extends Controller
{
    public function userdata(Request $request)
    {
        return $request->user();
    }

    public function getAllUser(Request $request)
    {
        $user = User::all();
        return response()->json([
            'status_code' => 200,
            'data' => $user,
        ]);
    }
}
