<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('study_pages', function (Blueprint $table) {
            $table->string('title_bn', 200)->nullable()->after('title');
            $table->longText('html_content_bn')->nullable()->after('html_content');
            $table->string('meta_title_bn', 180)->nullable()->after('meta_title');
            $table->string('meta_description_bn', 320)->nullable()->after('meta_description');
        });
    }

    public function down(): void
    {
        Schema::table('study_pages', function (Blueprint $table) {
            $table->dropColumn([
                'title_bn',
                'html_content_bn',
                'meta_title_bn',
                'meta_description_bn',
            ]);
        });
    }
};
