<?php
namespace App\BusinessLogic\Interfaces;

use App\Http\Requests\Api\Auth\{
    SigninRequest,
    SignupRequest
};

interface IAuthService {
    public function signin(SigninRequest $request);
    public function signup(SignupRequest $request);
    public function logout();
}
