<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (! $token = Auth::guard('api')->attempt($credentials)) {
            return response()->json([
                'message' => 'Invalid email or password'
            ], 401);
        }

        return $this->respondWithToken($token);
    }

    // USER INFO
    public function me()
    {
        return response()->json(Auth::guard('api')->user());
    }

    // LOGOUT
    public function logout(Request $request)
    {
        try {
            JWTAuth::invalidate(JWTAuth::getToken());

            return response()->json([
                'message' => 'Logged out successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Logout failed',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    protected function respondWithToken($token)
    {
        // return response()->json([
        //     'access_token' => $token,
        //     'token_type'   => 'bearer',
        //     'expires_in'   => JWTAuth::factory()->getTTL() * 60,
        //     'user'         => auth('api')->user()
        // ]);
        //Nếu Flutter không cần thời gian hết hạn:
        return response()->json([
        'access_token' => $token,
        'token_type'   => 'bearer',
        'user'         => auth('api')->user()
    ]);
    }

}
