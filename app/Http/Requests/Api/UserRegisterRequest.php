<?php

namespace App\Http\Requests\Api;

use App\RestFullApi\Facade\ApiResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Symfony\Component\HttpFoundation\Response;

class UserRegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name'=>['required','string','min:2','max:255'],
            'lastname'=>['required','string','min:2','max:255'],
            'email'=>['required','email','unique:users,email'],
            'password'=>['required','string','min:6','max:18'],
        ];
    }

    protected function failedValidation(Validator $validator){
        $errors=ApiResponse::withData($validator->errors())->withMessage('Please Fill This Error')->withStatus(Response::HTTP_UNPROCESSABLE_ENTITY)->Builder();
        throw new HttpResponseException($errors);
    }
}
