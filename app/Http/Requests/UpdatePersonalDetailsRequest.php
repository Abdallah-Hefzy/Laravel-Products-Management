<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePersonalDetailsRequest extends FormRequest
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
            'profile_photo'=>['nullable','image','max:1000','mimes:png,jpg,jepg'],
            'name'=>['required','string','max:255'],
            'city'=>['nullable','string'],
            'phone'=>['required','regex:/^01[0125][0-9]{8}$/'],
            'birthday'=>['nullable','date'],
            'gender'=>['required','in:male,female']
        ];
    }
}
