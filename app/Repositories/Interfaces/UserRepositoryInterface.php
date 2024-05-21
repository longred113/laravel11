<?php

namespace App\Repositories\Interfaces;

interface UserRepositoryInterface
{
    public function register($name, $email, $password);
    public function findEmail($email);
    public function passwordReset($email, $token);
    public function updatePassword($email, $password);
}
