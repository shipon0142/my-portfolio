<?php

namespace App\Models\Study;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Page extends Model
{
    use HasFactory;

    protected $table = 'study_pages';

    protected $fillable = [
        'topic_id', 'title', 'slug', 'template', 'page_number',
        'html_content', 'meta_title', 'meta_description',
        'status', 'published_at',
        'title_bn', 'html_content_bn', 'meta_title_bn', 'meta_description_bn',
    ];

    protected $casts = [
        'topic_id'     => 'int',
        'page_number'  => 'int',
        'published_at' => 'datetime',
    ];

    public function topic(): BelongsTo
    {
        return $this->belongsTo(Topic::class, 'topic_id');
    }

    public function scopePublished(Builder $q): Builder
    {
        return $q->where('status', 'published')
                 ->whereNotNull('published_at')
                 ->where('published_at', '<=', now());
    }

    public function hasBangla(): bool
    {
        return filled($this->html_content_bn);
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    protected static function newFactory()
    {
        return \Database\Factories\Study\PageFactory::new();
    }
}
