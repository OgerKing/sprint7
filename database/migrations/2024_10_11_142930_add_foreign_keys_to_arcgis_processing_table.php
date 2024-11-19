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
        Schema::table('arcgis_processing', function (Blueprint $table) {
            $table->foreign(['adjudication_section_id'], 'arcgis_processing_ibfk_1')->references(['id'])->on('adjudication_sections')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('arcgis_processing', function (Blueprint $table) {
            $table->dropForeign('arcgis_processing_ibfk_1');
        });
    }
};
