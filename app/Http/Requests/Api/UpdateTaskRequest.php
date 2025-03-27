<?php

namespace App\Http\Requests\Api;

use App\Enum\StatusTask;
use App\RestFullApi\Facade\ApiResponse;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Symfony\Component\HttpFoundation\Response;

class UpdateTaskRequest extends FormRequest
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
            'title'=>['required','string','min:2','max:255'],
            'note'=>['required','string','min:2','max:255'],
            'finished_at'=>['nullable','date','date_format:Y-m-d'],
            'status'=>['required',new Enum(StatusTask::class)]
        ];
    }
    protected function failedValidation(Validator $validator){
        $errors=ApiResponse::withData($validator->errors())->withMessage('Please Fill This Error')->withStatus(Response::HTTP_UNPROCESSABLE_ENTITY)->Builder();
        throw new HttpResponseException($errors);
    }
}
