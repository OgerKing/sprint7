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
        Schema::table('court_case_adjudication_sections', function (Blueprint $table) {
            $table->foreign(['adjudication_section_id'], 'court_case_adjudication_sections_ibfk_1')->references(['id'])->on('adjudication_sections')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['court_case_id'], 'court_case_adjudication_sections_ibfk_2')->references(['id'])->on('court_cases')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('court_case_adjudication_sections', function (Blueprint $table) {
            $table->dropForeign('court_case_adjudication_sections_ibfk_1');
            $table->dropForeign('court_case_adjudication_sections_ibfk_2');
        });
    }
};
