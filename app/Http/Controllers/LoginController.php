<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function tambah(Request $request)
    {
        try {
            // Validasi input
            $validatedData = $request->validate([
                'name' => 'required|max:255',
                'email' => 'required|email|unique:users',
                'password' => 'required|min:5|max:255'
            ]);

            // Enkripsi password sebelum disimpan
            // $validatedData['password'] = Hash::make($validatedData['password']);

            // Simpan data user baru
            $user = User::create($validatedData);

            // Kembalikan respon JSON
            return response()->json([
                'success' => true,
                'message' => 'Registration successful',
                'data' => $user
            ], 201); // 201 = Created

        } catch (\Illuminate\Validation\ValidationException $e) {
            // Tangkap error validasi dan kirim ke Flutter
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422); // 422 = Unprocessable Entity
        } catch (\Exception $e) {
            // Tangkap error umum
            return response()->json([
                'success' => false,
                'message' => 'Server error: ' . $e->getMessage()
            ], 500);
        }
    }

    public function authenticate(Request $request)
    {
        // Validasi input
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:5'
        ]);

        // Coba login
        if (!Auth::attempt($credentials)) {
            return response()->json([
                'success' => false,
                'message' => 'Login failed! Email or password incorrect.'
            ], 401); // Unauthorized
        }

        // Jika berhasil login, buat token API
        $user = Auth::user();
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'success' => true,
            'message' => 'Login successful.',
            'user' => $user,
            'token' => $token
        ], 200);
    }

    public function logout(Request $request)
    {
        // Hapus token API yang sedang aktif
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'success' => true,
            'message' => 'Logout successful.'
        ], 200);
    }

}
