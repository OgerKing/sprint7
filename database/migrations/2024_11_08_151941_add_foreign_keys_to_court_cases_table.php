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
        Schema::table('court_cases', function (Blueprint $table) {
            $table->foreign(['court_id'], 'court_cases_ibfk_1')->references(['id'])->on('courts')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['court_judge_id'], 'court_cases_ibfk_2')->references(['id'])->on('court_personnel')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['court_master_id'], 'court_cases_ibfk_3')->references(['id'])->on('court_personnel')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('court_cases', function (Blueprint $table) {
            $table->dropForeign('court_cases_ibfk_1');
            $table->dropForeign('court_cases_ibfk_2');
            $table->dropForeign('court_cases_ibfk_3');
        });
    }
};
