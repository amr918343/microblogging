<?php

namespace App\Http\Requests\Api\Auth;

use App\Http\Requests\Api\ApiMasterRequest;
use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Http\{
    Exceptions\HttpResponseException,
    JsonResponse
};

class SignupRequest extends ApiMasterRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'email'                 => 'required|regex:/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/|unique:users,email',
            'username'              => ['required', 'regex:/^\S*$/'],
            'password'              => ['required', 'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[^a-zA-Z\d\s]).{8,}$/'],
            'image'                 => ['image', 'mimes:png,jpg', 'max:1024'],
        ];
    }

    public function messages() {
        return [
            'password.regex' => __('password_validation'),
            'username'       => __('username_validation')
        ];
    }
}
