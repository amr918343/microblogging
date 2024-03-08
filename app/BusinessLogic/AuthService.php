<?php

namespace App\BusinessLogic;

use App\BusinessLogic\Interfaces\IAuthService;
use App\Enums\ResponseMethodEnum;
use App\Http\Resources\Api\User\UserResource;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests\Api\Auth\{
    SigninRequest,
    SignupRequest
};

class AuthService implements IAuthService {
    public function signin(SigninRequest $request)
    {
        if (Auth::attempt($this->getCredentials($request))) {
            $user = auth('api')->user();

            $token = $user->createToken('api_token')->plainTextToken;
            data_set($user, 'token', $token);

            return generalApiResponse(method: ResponseMethodEnum::CUSTOM_SINGLE, resource: UserResource::class, dataPassed: $user, customMessage: __('Signedin successfully'));
        }
        return generalApiResponse(method: ResponseMethodEnum::CUSTOM, customMessage: __('Wrong credentials'), customStatusMsg: 'fail', customStatus: 422);
    }

    public function signup(SignupRequest $request)
    {
        $user = User::create(array_except($request->validated(), ['image']));

        $token = $user->createToken('api_token')->plainTextToken;

        data_set($user, 'token', $token);

        return generalApiResponse(method: ResponseMethodEnum::CUSTOM_SINGLE, resource: UserResource::class, dataPassed: $user, customMessage: __('Signedup successfully'));
    }


    public function logout()
    {
        $user = auth('api')->user();
        $user->tokens()->delete();
        return generalApiResponse(method: ResponseMethodEnum::CUSTOM, customMessage: __('Loggeout successfully'));
    }

    private function getCredentials($request)
    {
        $credentials = [
            'email' =>$request->email,
            'password' => $request->password
        ];

        return $credentials;
    }
}
