<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\EmailForm;
use App\Mail\testForm;
use App\Notifications\ResetPasswordRequest;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
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
        $this->request->validate([
            'email' => 'required|email',
        ]);
        $user = $this->userRepository->findEmail($this->request->email);
        $token = Str::random(60);
        $passwordReset  = $this->userRepository->passwordReset($this->request->email, $token);
        // dd($passwordReset->token);
        Mail::to('long@gmail.com')->send(new EmailForm($passwordReset->token));
        if ($passwordReset) {
            $user->notify(new ResetPasswordRequest($passwordReset->token));
        }
        return response()->json([
            'message' => 'We have e-mailed your password reset link!'
        ]);
    }

    public function reset()
    {
        $passwordReset = $this->userRepository->passwordReset($this->request->email, $this->request->token);
        if (Carbon::parse($passwordReset->updated_at)->addMinutes(720)->isPast()) {
            $passwordReset->delete();
            return response()->json([
                "message" => "This password reset token is invalid.",
            ], 422);
        }
        $updatePasswordUser = $this->userRepository->updatePassword($passwordReset->email, $this->request->password);
        $passwordReset->delete();
        return response()->json([
            'message' => 'Your password has been reset!',
            'data' => $updatePasswordUser,
        ]);
    }
}
