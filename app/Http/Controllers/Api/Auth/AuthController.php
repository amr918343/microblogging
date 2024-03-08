<?php

namespace App\Http\Controllers\Api\Auth;

use App\BusinessLogic\Interfaces\IAuthService;
use App\Http\Controllers\Controller;

use App\Http\Requests\Api\Auth\{
    SigninRequest,
    SignupRequest
};
use Illuminate\Support\Facades\{
    Auth,
    Storage
};

// Assuming you have this interface defined

class AuthController extends Controller implements IAuthService
{
    private IAuthService $_authService;

    public function __construct(IAuthService $authService)
    {
        $this->_authService = $authService;
    }

    public function signup(SignupRequest $request)
    {
        return $this->_authService->signup($request);
    }

    public function signin(SigninRequest $request)
    {
        return $this->_authService->signin($request);
    }


    public function logout()
    {
        return $this->_authService->logout();
    }
}
