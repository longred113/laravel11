<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use UserRepository;

class UserController extends Controller
{
    protected $request;
    protected $userRepository;

    public function __construct(Request $request, UserRepositoryInterface $userRepository)
    {
        $this->request = $request;
        $this->userRepository = $userRepository;
        // $this->middleware('auth:api', ['except' => ['login', 'register',]]);
    }
    public function register()
    {
        $this->request->validate([
            "name" => "required|string",
            "email" => "required|string|email|unique:users",
            "password" => "required|confirmed",
        ]);

        $user = $this->userRepository->register(
            $this->request->name,
            $this->request->email,
            $this->request->password
        );

        return response()->json([
            "status" => true,
            "message" => "user create successfully",
            "data" => $user,
        ]);
    }

    public function login()
    {
        $this->request->validate([
            "email" => "required|email",
            "password" => "required",
        ]);

        $token = auth()->attempt([
            "email" => $this->request->email,
            "password" => $this->request->password,
        ]);

        if (!$token) {
            return response()->json([
                "status" => false,
                "message" => "Unauthorized",
            ]);
        }

        $cookie = Cookie("authToken", $token, 60 * 24 * 7);

        return response()->json([
            "status" => true,
            "message" => "user login successfully",
            "token" => $token,
            "expires_in" => auth()->factory()->getTTL() * 60,
        ])->withCookie($cookie);
    }

    public function refresh()
    {
        $token = auth()->refresh();
        return response()->json([
            "status" => true,
            "message" => "user refresh successfully",
            "token" => $token,
            "expires_in" => auth()->factory()->getTTL() * 60,
        ]);
    }

    public function profile()
    {
        $userData = auth()->user();
        return response()->json([
            "status" => true,
            "message" => "user profile",
            "data" => $userData,
        ]);
    }

    public function logout()
    {
        // Cookie::queue(Cookie::forget("authToken"));
        auth()->logout();
        return response()->json([
            "status" => true,
            "message" => "user logout successfully",
        ])->withoutCookie("authToken");
    }
}
