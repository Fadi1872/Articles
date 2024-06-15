<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreArticleRequest extends FormRequest
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
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            return [
                'title' => 'required|string|max:255',
                'body' => 'required|string|max:10000',
                'image' => 'required|image|mimes:jpg,jpeg,png,gif|max:5048',
                'category_id' => 'required|exists:categories,id'
            ];
        } else {
            return [
                'title' => 'required|string|max:255',
                'body' => 'required|string|max:10000',
                'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:5048',
                'category_id' => 'required|exists:categories,id'
            ]; 
        }
    }
}
