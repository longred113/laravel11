<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Notifications\ResetPasswordRequest;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ResetPasswordController extends Controller
{
    protected $userRepository;
    protected $request;
    public function __construct(UserRepositoryInterface $userRepository, Request $request)
    {
        $this->userRepository = $userRepository;
        $this->request = $request;
    }
    public function sendMail()
    {
        $user = $this->userRepository->findEmail($this->request->email);
        $token = Str::random(60);
        $passwordReset  = $this->userRepository->passwordReset($this->request->email, $token);
        if ($passwordReset) {
            $user->notify(new ResetPasswordRequest($passwordReset->token));
        }
        return response()->json([
            'message' => 'We have e-mailed your password reset link!'
        ]);
    }

    public function reset()
    {
    }
}
