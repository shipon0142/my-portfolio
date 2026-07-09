<?php

namespace App\Http\Requests\Admin\Study;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UploadImageRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->is_admin === true;
    }

    public function rules(): array
    {
        return [
            'upload' => ['required', 'image', 'mimes:jpeg,png,webp,gif', 'max:4096'],
        ];
    }

    public function messages(): array
    {
        return [
            'upload.required' => 'Please choose an image.',
            'upload.image'    => 'The file must be an image.',
            'upload.mimes'    => 'Only JPEG, PNG, WEBP, or GIF images are allowed.',
            'upload.max'      => 'The image must be smaller than 4 MB.',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        // CKEditor's SimpleUploadAdapter expects { error: { message } } on failure.
        throw new HttpResponseException(
            response()->json(
                ['error' => ['message' => $validator->errors()->first('upload')]],
                422
            )
        );
    }
}
