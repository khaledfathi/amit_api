<?php

namespace App\Http\Requests\API\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateUserRequest extends FormRequest
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
        $this->merge(['id' => $this->route('id')]);
        return [
            'id' => 'numeric', 
            'name'=> 'nullable|max:255',
            'email'=> "required|email|unique:users,email,$this->id", 
            'password'=> "nullable", 
            'image'=> 'nullable|mimes:jpg,jpge,bmp,png,tiff,webp,heif|max:10000',
        ];

    }
    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'message'=>'one or more fileds is invalid !',
            'errors' => $validator->errors()->all(),
        ], 400));
    }
}
