<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;

class AuthController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

       // $user = $this->userRepository::create($validator);
        $role = $this->determineUserRole($request->role);
        $user->assignRole($role);

        $token = $user->createToken('Personal Access Token')->accessToken;

        return response()->json(['token' => $token , 'role' => $user->getAllPermissions()], 201);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $token = $user->createToken('Personal Access Token')->accessToken;

            return response()->json(['token' => $token, 'role' => $user->getAllPermissions()], 200);
        } else {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    }

    public function user(Request $request)
    {
        return response()->json($request->user());
    }

    protected function determineUserRole($role)
    {
        return Role::where('name', $role)->first();
    }
}
