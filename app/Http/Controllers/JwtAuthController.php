<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use JWTAuth;
use Validator;

use App\User;
use App\Role;

class JwtAuthController extends Controller
{
    public $token = true;

    public function __construct() {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    public function register(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|between:2,100',
            'email' => 'required|email|unique:users|max:50',
            'password' => 'required|confirmed|string|min:6',
        ]);

        $user = User::create(array_merge(
            $validator->validated(),
            ['password' => bcrypt($request->password)]
        ));

        return response()->json([
            'error' => false,
            'message' => 'Registered Successfully.'
        ], Response::HTTP_CREATED);
    }

    public function login(Request $request) {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:6'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => true,
                'message' => 'E-mail or Password Invalid.'
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }`ca

        if (! $token = auth()->attempt($validator->validated())) {
            return response()->json([
                'error' => true,
                'message' => 'Unauthorized.'
            ], Response::HTTP_UNAUTHORIZED);
        }

        return $this->createNewToken($token);
    }

    public function profile() {
        return response()->json([
            'error' => false,
            'data' => auth()->user()
        ], Response::HTTP_OK);
    }

    public function logout(Request $request) {
        auth()->logout();

        return response()->json([
            'error' => false,
            'message' => 'logged out.'
        ], Response::HTTP_OK);
    }

    public function refresh() {
        return $this->createNewToken(auth()->refresh());
    }

    protected function createNewToken($token) {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ], Response::HTTP_OK);
    }
}
