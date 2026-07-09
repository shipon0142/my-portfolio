<?php

namespace App\Http\Requests\Admin\Study;

use App\Services\Study\HtmlSanitizer;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class StorePageRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->is_admin === true;
    }

    protected function prepareForValidation(): void
    {
        $sanitizer = app(HtmlSanitizer::class);

        $htmlContentBn = $this->input('html_content_bn');

        $this->merge([
            'slug' => blank($this->input('slug'))
                        ? Str::slug((string) $this->input('title'))
                        : $this->input('slug'),
            'html_content'    => $sanitizer->clean((string) $this->input('html_content')),
            'html_content_bn' => filled($htmlContentBn)
                ? $sanitizer->clean((string) $htmlContentBn)
                : null,
        ]);
    }

    public function rules(): array
    {
        $topicId = $this->route('topic')?->id;

        return [
            'title'               => ['required', 'string', 'max:200'],
            'slug'                => ['required', 'string', 'max:220', 'alpha_dash',
                                      Rule::unique('study_pages', 'slug')->where('topic_id', $topicId)],
            'template'            => ['required', 'string', Rule::in(array_keys(config('study.templates')))],
            'html_content'        => ['required', 'string', 'min:1'],
            'meta_title'          => ['nullable', 'string', 'max:180'],
            'meta_description'    => ['nullable', 'string', 'max:320'],
            'status'              => ['required', Rule::in(['draft', 'published'])],
            'title_bn'            => ['nullable', 'string', 'max:200'],
            'html_content_bn'     => ['nullable', 'string'],
            'meta_title_bn'       => ['nullable', 'string', 'max:180'],
            'meta_description_bn' => ['nullable', 'string', 'max:320'],
        ];
    }
}
