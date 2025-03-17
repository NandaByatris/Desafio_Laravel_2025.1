<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function getUsers(Request $request)
    {
              $users = User::paginate(6);
              $response = [
            'users' => $users->map(function ($user) {
                return [
                    'name' => $user->name,
                    'photo' => $user->photo ? asset('storage/' . $user->photo) : null,
                ];
            }),
            'totalPages' => $users->lastPage(),
            'status' => 200,
        ];

        return response()->json($response, 200);
    }
    public function getAdmins(Request $request)
    {
        $admins = User::where('is_admin', true)->paginate(6);

        $response = [
            'users' => $admins->map(function ($user) {
                return [
                    'name' => $user->name,
                    'photo' => $user->photo ? asset('storage/' . $user->photo) : null,
                ];
            }),
            'totalPages' => $admins->lastPage(),
            'status' => 200,
        ];

        return response()->json($response, 200);
    }
}
