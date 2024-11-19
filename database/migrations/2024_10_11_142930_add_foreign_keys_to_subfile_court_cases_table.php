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
        Schema::table('subfile_court_cases', function (Blueprint $table) {
            $table->foreign(['court_case_id'], 'subfile_court_cases_ibfk_1')->references(['id'])->on('court_cases')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['subfile_id'], 'subfile_court_cases_ibfk_2')->references(['id'])->on('subfiles')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('subfile_court_cases', function (Blueprint $table) {
            $table->dropForeign('subfile_court_cases_ibfk_1');
            $table->dropForeign('subfile_court_cases_ibfk_2');
        });
    }
};
