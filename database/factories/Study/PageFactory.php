<?php

namespace Database\Factories\Study;

use App\Models\Study\Page;
use App\Models\Study\Topic;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PageFactory extends Factory
{
    protected $model = Page::class;

    public function definition(): array
    {
        $title = $this->faker->unique()->sentence(3);
        return [
            'topic_id'         => Topic::factory(),
            'title'            => $title,
            'slug'             => Str::slug($title),
            'template'         => 'article',
            'html_content'     => '<p>Sample</p>',
            'meta_title'       => null,
            'meta_description' => null,
            'status'           => 'draft',
            'published_at'     => null,
        ];
    }
}
