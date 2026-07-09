<?php

namespace App\Http\Requests\Admin\Study;

use App\Services\Study\HtmlSanitizer;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class UpdatePageRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->is_admin === true;
    }

    protected function prepareForValidation(): void
    {
        $sanitizer = app(HtmlSanitizer::class);

        $this->merge([
            'slug' => blank($this->input('slug'))
                        ? Str::slug((string) $this->input('title'))
                        : $this->input('slug'),
            'html_content' => $sanitizer->clean((string) $this->input('html_content')),
        ]);
    }

    public function rules(): array
    {
        $topicId = $this->route('topic')?->id;
        $pageId  = $this->route('page')?->id;

        return [
            'title'            => ['required', 'string', 'max:200'],
            'slug'             => ['required', 'string', 'max:220', 'alpha_dash',
                                   Rule::unique('study_pages', 'slug')
                                       ->where('topic_id', $topicId)
                                       ->ignore($pageId)],
            'template'         => ['required', 'string', Rule::in(array_keys(config('study.templates')))],
            'html_content'     => ['required', 'string', 'min:1'],
            'meta_title'       => ['nullable', 'string', 'max:180'],
            'meta_description' => ['nullable', 'string', 'max:320'],
            'status'           => ['required', Rule::in(['draft', 'published'])],
        ];
    }
}
