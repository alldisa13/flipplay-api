<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreMediaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $isPost = $this->isMethod('POST');
        $req = $isPost ? 'required' : 'sometimes';

        return [
            'type'         => [$req, 'in:anime,film'],
            'title'        => [
                $req,
                'string',
                'max:255',
                Rule::unique('media', 'title')->ignore($this->route('media')),
            ],
            'year'         => [$req, 'integer', 'min:1888', 'max:2100'],
            'rating'       => [$req, 'numeric', 'between:0,10'],
            'is_available' => ['sometimes', 'boolean'],

            'episodes' => [$isPost ? 'required_if:type,anime' : 'sometimes', 'nullable', 'integer', 'min:1'],
            'studio'   => [$isPost ? 'required_if:type,anime' : 'sometimes', 'nullable', 'string', 'max:255'],
            'duration' => [$isPost ? 'required_if:type,film'  : 'sometimes', 'nullable', 'integer', 'min:1'],
            'director' => [$isPost ? 'required_if:type,film'  : 'sometimes', 'nullable', 'string', 'max:255'],
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Judul media wajib diisi',
            'title.unique'   => 'Judul media sudah ada',
            'type.in'        => 'Jenis harus anime atau film',
            'rating.between' => 'Rating harus antara 0 sampai 10',
        ];
    }
}
