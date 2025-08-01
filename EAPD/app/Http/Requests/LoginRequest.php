<?php

namespace App\Http\Requests;

use App\Helpers\ApiResponser;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
class LoginRequest extends FormRequest
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
            'email'=>'required|email',
            'password'=>'required'
        ];
    }

       public function messages(){
        return [
            'email.required' => 'The email field is required.',
            'email.email'=>'The field email must be type email',
            'password.required'=>'The Password Field is required'
        ];
    }

      protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            ApiResponser::validationErrorResponse($validator->errors())
        );
    }


}
