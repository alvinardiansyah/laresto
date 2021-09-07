<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Request\RegisterAuthRequest;
use Tymon\JwtAuth\Exceptions\JWTException;
use Symfony\Component\HttpFoundation\Response;
use JWTAuth;
use Validator;

use App\User;
use App\Role;

class JwtAuthController extends Controller
{
    public $token = true;

    public function register(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'password_confirmation' => 'required|same:password'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => true,
                'message' => $validator->errors()
            ], 401);
        }

        $user = User::create([
            'name' => $request->name,
            'role_id' => $request->role_id,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        if ($this->token) {
            return $this->login($request);
        }

        return response()->json([
            'error' => false,
            'data' => $user
        ], Response::HTTP_OK);
    }

    public function login(Request $request) {
        $input = $request->only('email', 'password');
        $jwt_token = null;
        if (!$jwt_token = JWTAuth::attemp($input)) {
            return response()->json([
                'error' => true,
                'message' => 'Invalid Email or Password'
            ], Response::HTTP_UNAUTHORIZED);
        }

        return response()->json([
            'error' => false,
            'message' => 'Logged in',
            'token' => $jwt_token
        ]);
    }

    public function logout(Request $request) {
        $this->validate($request, [
            'token' => 'required'
        ]);

        try {
            JWTAuth::invalidate($request->token);
            return response()->json([
                'error' => false,
                'message' => 'Logged out'
            ]);
        } catch (JWTException $exception) {
            return response()->json([
                'error' => true,
                'message' => 'Fail to log out'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function getUser(Request $request) {
        $this->validate($request, [
            'token' => 'required'
        ]);

        $user = JWTAuth::authenticate($request->token);
        return response()->json([
            'error' => false,
            'data' => $user
        ]);
    }
}
