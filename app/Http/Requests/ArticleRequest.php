<?php

namespace App\Http\Requests;

use App\Rules\NoRestrictedWords;
use Illuminate\Foundation\Http\FormRequest;

class ArticleRequest extends FormRequest
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
            'title' => 'required|string|min:5|max:255', 
            'description' => ['nullable', 'string', 'max:5000', new NoRestrictedWords()], 
            'category_id' => 'required|exists:category,id', 
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];        
    }
}
