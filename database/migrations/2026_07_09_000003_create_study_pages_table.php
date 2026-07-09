<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('study_pages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('topic_id')
                ->constrained('study_topics')
                ->cascadeOnDelete();
            $table->string('title', 200);
            $table->string('slug', 220);
            $table->string('template', 40);
            $table->longText('html_content');
            $table->string('meta_title', 180)->nullable();
            $table->string('meta_description', 320)->nullable();
            $table->enum('status', ['draft', 'published'])->default('draft');
            $table->timestamp('published_at')->nullable();
            $table->timestamps();

            $table->unique(['topic_id', 'slug']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('study_pages');
    }
};
