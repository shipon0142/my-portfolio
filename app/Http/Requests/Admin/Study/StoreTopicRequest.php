<?php

namespace App\Http\Requests\Admin\Study;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class StoreTopicRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->is_admin === true;
    }

    protected function prepareForValidation(): void
    {
        if (blank($this->input('slug'))) {
            $this->merge(['slug' => Str::slug((string) $this->input('title'))]);
        }
    }

    public function rules(): array
    {
        return [
            'title'       => ['required', 'string', 'max:120'],
            'slug'        => ['required', 'string', 'max:140', 'alpha_dash', 'unique:study_topics,slug'],
            'description' => ['nullable', 'string', 'max:1000'],
            'sort_order'  => ['nullable', 'integer', 'min:0'],
        ];
    }
}
