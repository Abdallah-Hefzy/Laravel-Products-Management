<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
            'name'=>['required','string','max:255'],
            // 'slug'=>['required','unique:products,slug','string'],
            'description'=>['required','string'],
            'image'=>['image','max:1000','mimes:png,jpg,jepg'],
            'price'=>['required','numeric'],
            'quantity'=>['required','min:1','integer'],
            'status'=>['required','in:active,inactive'],
            'category_id'=>['required','exists:categories,id','integer'],
            'subcategory_id'=>['required','exists:subcategories,id','integer'],
            'brand_id'=>['required','exists:brands,id','integer'],

        ];
    }
}
