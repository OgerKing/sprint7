<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('water_right_comments', function (Blueprint $table) {
            $table->foreign(['water_right_comment_category_id'], 'water_right_comments_ibfk_1')->references(['id'])->on('water_right_comment_categories')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['water_right_id'], 'water_right_comments_ibfk_2')->references(['id'])->on('water_rights')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('water_right_comments', function (Blueprint $table) {
            $table->dropForeign('water_right_comments_ibfk_1');
            $table->dropForeign('water_right_comments_ibfk_2');
        });
    }
};
