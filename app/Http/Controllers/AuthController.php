<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class AuthController extends Controller
{

    public function register(Request $request)
    {
        /**
         * ==========1===========
         * Validasi data registrasi yang masuk
         */
        $validator = Validator::make($request->all(), [
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|unique:users|max:255',
            'password' => 'required|string|min:8',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Please check your request',
                'errors' => $validator->errors()
            ], 422);
        }


        /**
         * =========2===========
         * Buat user baru dan generate token API, atur masa berlaku token 1 jam
         */
        $data = $validator->validated();

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        $tokenResult = $user->createToken('auth_token');
        if (isset($tokenResult->accessToken)) {
            $tokenResult->accessToken->expires_at = now()->addHour();
            $tokenResult->accessToken->save();
        }
        $plainToken = $tokenResult->plainTextToken;



        /**
         * =========3===========
         * Kembalikan response sukses dengan data $user dan $token
         */
        return response()->json([
            'message' => 'User registered successfully',
            'user' => $user,
            'token' => $plainToken,
            'token_type' => 'Bearer',
            'expires_at' => now()->addHour()->toDateTimeString()
        ], 201);
    }


    public function login(Request $request)
    {
        /**
         * =========4===========
         * Validasi data login yang masuk
         */
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Please check your request',
                'errors' => $validator->errors()
            ], 422);
        }

        $credentials = $validator->validated();

        /**
         * =========5===========
         * Generate token API untuk user yang terautentikasi
         * Atur token agar expired dalam 1 jam
         */
        if (!Auth::attempt($credentials)) {
            return response()->json([
                'message' => 'Invalid credentials'
            ], 401);
        }

        $user = Auth::user();

        $tokenResult = $user->createToken('auth_token');
        if (isset($tokenResult->accessToken)) {
            $tokenResult->accessToken->expires_at = now()->addHour();
            $tokenResult->accessToken->save();
        }
        $plainToken = $tokenResult->plainTextToken;

        /**
         * =========6===========
         * Kembalikan response sukses dengan data $user dan $token
         */
        return response()->json([
            'message' => 'Login successful',
            'user' => $user,
            'token' => $plainToken,
            'token_type' => 'Bearer',
            'expires_at' => now()->addHour()->toDateTimeString()
        ], 200);
    }

        public function logout(Request $request)
        {
            /**
             * =========7===========
             * Invalidate token yang digunakan untuk autentikasi request saat ini
             */
            $user = $request->user();
            if ($user && $request->user()->currentAccessToken()) {
                $request->user()->currentAccessToken()->delete();
            }
    
            /**
             * =========8===========
             * Kembalikan response sukses
             */
            return response()->json([
                'message' => 'Logged out successfully'
            ], 200);
        }
    }
