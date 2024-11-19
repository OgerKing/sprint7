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
        Schema::table('water_rights', function (Blueprint $table) {
            $table->foreign(['subfile_id'], 'water_rights_ibfk_1')->references(['id'])->on('subfiles')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['amount_category_id'], 'water_rights_ibfk_2')->references(['id'])->on('amount_categories')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['hs_recommendation_id'], 'water_rights_ibfk_3')->references(['id'])->on('hs_recommendations')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['water_right_use_id'], 'water_rights_ibfk_4')->references(['id'])->on('water_right_uses')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['water_source_id'], 'water_rights_ibfk_5')->references(['id'])->on('water_sources')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('water_rights', function (Blueprint $table) {
            $table->dropForeign('water_rights_ibfk_1');
            $table->dropForeign('water_rights_ibfk_2');
            $table->dropForeign('water_rights_ibfk_3');
            $table->dropForeign('water_rights_ibfk_4');
            $table->dropForeign('water_rights_ibfk_5');
        });
    }
};
