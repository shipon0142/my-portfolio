<?php

namespace App\Models\Study;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Topic extends Model
{
    use HasFactory;

    protected $table = 'study_topics';

    protected $fillable = ['title', 'slug', 'description', 'sort_order'];

    protected $casts = ['sort_order' => 'int'];

    public function pages(): HasMany
    {
        return $this->hasMany(Page::class, 'topic_id');
    }

    public function publishedPages(): HasMany
    {
        return $this->pages()->published();
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    protected static function newFactory()
    {
        return \Database\Factories\Study\TopicFactory::new();
    }
}
