<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('study_pages', function (Blueprint $table) {
            $table->unsignedInteger('page_number')->default(0)->after('template');
            $table->index(['topic_id', 'page_number']);
        });

        foreach (DB::table('study_topics')->pluck('id') as $topicId) {
            $i = 1;
            foreach (DB::table('study_pages')->where('topic_id', $topicId)->orderBy('id')->pluck('id') as $pageId) {
                DB::table('study_pages')->where('id', $pageId)->update(['page_number' => $i++]);
            }
        }
    }

    public function down(): void
    {
        Schema::table('study_pages', function (Blueprint $table) {
            $table->dropIndex(['topic_id', 'page_number']);
            $table->dropColumn('page_number');
        });
    }
};
