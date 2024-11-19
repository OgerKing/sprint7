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
        Schema::create('court_case_adjudication_sections', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->bigInteger('court_case_id')->index('ccas_court_cases_index');
            $table->bigInteger('adjudication_section_id')->index('ccas_adjudication_section_index');
            $table->timestamp('created_at')->nullable();
            $table->string('created_by', 64);
            $table->timestamp('updated_at')->nullable();
            $table->string('updated_by', 64);
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('court_case_adjudication_sections');
    }
};
