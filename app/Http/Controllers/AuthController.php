<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
<<<<<<< HEAD
use Carbon\Carbon; // tambahkan untuk mengatur waktu kedaluwarsa token
=======
>>>>>>> 0dfb2fa5e1f9378ad8fdbf5708fc33b3dc077aca

class AuthController extends Controller
{

    public function register(Request $request)
    {
        /**
         * ==========1===========
         * Validasi data registrasi yang masuk
         */
<<<<<<< HEAD
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
=======

>>>>>>> 0dfb2fa5e1f9378ad8fdbf5708fc33b3dc077aca

        /**
         * =========2===========
         * Buat user baru dan generate token API, atur masa berlaku token 1 jam
         */
<<<<<<< HEAD
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // buat token dengan masa berlaku 1 jam
        $tokenResult = $user->createToken('authToken', ['*'], Carbon::now()->addHour());
        $token = $tokenResult->plainTextToken;
=======


>>>>>>> 0dfb2fa5e1f9378ad8fdbf5708fc33b3dc077aca

        /**
         * =========3===========
         * Kembalikan response sukses dengan data $user dan $token
         */
<<<<<<< HEAD
        return response()->json([
            'message' => 'Register successful',
            'user' => $user,
            'token' => $token,
            'token_expires_at' => Carbon::now()->addHour()
        ], 201);
=======

>>>>>>> 0dfb2fa5e1f9378ad8fdbf5708fc33b3dc077aca
    }


    public function login(Request $request)
    {
        /**
         * =========4===========
         * Validasi data login yang masuk
         */
<<<<<<< HEAD
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json(['message' => 'Email or password incorrect'], 401);
        }

        $user = Auth::user();
=======
>>>>>>> 0dfb2fa5e1f9378ad8fdbf5708fc33b3dc077aca

        /**
         * =========5===========
         * Generate token API untuk user yang terautentikasi
         * Atur token agar expired dalam 1 jam
         */
<<<<<<< HEAD
        $tokenResult = $user->createToken('authToken', ['*'], Carbon::now()->addHour());
        $token = $tokenResult->plainTextToken;
=======
>>>>>>> 0dfb2fa5e1f9378ad8fdbf5708fc33b3dc077aca

        /**
         * =========6===========
         * Kembalikan response sukses dengan data $user dan $token
         */
<<<<<<< HEAD
        return response()->json([
            'message' => 'Login successful',
            'user' => $user,
            'token' => $token,
            'token_expires_at' => Carbon::now()->addHour()
        ], 200);
=======

>>>>>>> 0dfb2fa5e1f9378ad8fdbf5708fc33b3dc077aca
    }

    public function logout(Request $request)
    {
        /**
         * =========7===========
         * Invalidate token yang digunakan untuk autentikasi request saat ini
         */
<<<<<<< HEAD
        $request->user()->currentAccessToken()->delete();
=======

>>>>>>> 0dfb2fa5e1f9378ad8fdbf5708fc33b3dc077aca

        /**
         * =========8===========
         * Kembalikan response sukses
         */
<<<<<<< HEAD
        return response()->json([
            'message' => 'Successfully logged out'
        ]);
=======

>>>>>>> 0dfb2fa5e1f9378ad8fdbf5708fc33b3dc077aca
    }
}
