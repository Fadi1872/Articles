<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class AuthorRequest extends FormRequest
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
            
        'name' => [
            'required',
            'string',
            Rule::unique('users')->ignore($this->user()->id),
        ],
        'email' => [
            'required',
            'email',
            Rule::unique('users')->ignore($this->user()->id),
        ],
        'password' => [
            'nullable',
            'min:8',
        ],
        'country' =>[
        'required',
        
    
        ] ,
            'address' => [
            'required',
           ' text,'
        ],
            'file' => [
            'nullable',
            'file',
           ' mimetypes:application/pdf',
            'naxL5048'],
        
        ];
    
    }
}
