<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class AddToCollectionRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'media_id' => 'required|integer|exists:media,id',
        ];
    }

    public function messages(): array
    {
        return [
            'media_id.required' => 'media_id wajib diisi',
            'media_id.exists'   => 'Media tidak ditemukan',
        ];
    }
}
