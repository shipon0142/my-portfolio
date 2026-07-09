<?php

namespace Database\Factories\Study;

use App\Models\Study\Topic;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class TopicFactory extends Factory
{
    protected $model = Topic::class;

    public function definition(): array
    {
        $title = $this->faker->unique()->words(2, true);
        return [
            'title'       => ucwords($title),
            'slug'        => Str::slug($title),
            'description' => $this->faker->sentence(),
            'sort_order'  => 0,
        ];
    }
}
