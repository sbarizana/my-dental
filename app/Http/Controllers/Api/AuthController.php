<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => ['required', 'confirmed', Password::defaults()],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
                'message' => 'Registration failed. Please check your input.',
            ], 422);
        }

        // Buat user baru
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Login user dan buat token
        Auth::login($user);
        $responseData = [
            'token' => $user->createToken($user->name)->plainTextToken,
            'name' => $user->name,
        ];

        // Kirim respons sukses
        return response()->json([
            'success' => true,
            'data' => $responseData,
            'message' => 'User successfully registered.',
        ]);
    }

    public function getUser(Request $request)
    {
        return response()->json([
            'success' => true,
            'data' => $request->user(),
        ], 200);
    }

    public function logout(Request $request)
    {
        // Ambil pengguna yang sedang login
        $user = Auth::user();

        // Periksa apakah pengguna memiliki token
        if ($user->tokens->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'No active tokens found for this user.',
            ], 404);
        }

        // Hapus semua token yang terkait dengan pengguna
        $user->tokens->each(function ($token) {
            $token->delete();
        });

        // Kirim respons sukses
        return response()->json([
            'success' => true,
            'message' => 'Successfully logged out.',
        ], 200);
    }

    public function login(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation errors occurred.',
                'errors' => $validator->errors(),
            ], 422);
        }

        // Verifikasi kredensial
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            $responseData = [
                'token' => $user->createToken($user->name)->plainTextToken,
                'name' => $user->name,
            ];

            // Kirim respons sukses
            return response()->json([
                'success' => true,
                'message' => 'Login successful.',
                'data' => $responseData,
            ], 200);
        }

        // Kredensial salah
        return response()->json([
            'success' => false,
            'message' => 'Invalid credentials.',
        ], 401);
    }
}
