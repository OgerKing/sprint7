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
        Schema::create('court_cases', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->bigInteger('court_id')->index();
            $table->string('case_number', 50)->nullable();
            $table->string('case_name', 2000)->nullable();
            $table->string('court_docket_link', 120)->nullable();
            $table->string('docket_number', 50)->nullable();
            $table->bigInteger('court_judge_id')->nullable()->index('court_cases_judge_id_index');
            $table->bigInteger('court_master_id')->nullable()->index('court_cases_master_id_index');
            $table->date('court_case_open_date')->nullable();
            $table->date('court_case_close_date')->nullable();
            $table->timestamp('created_at')->nullable();
            $table->string('created_by', 64);
            $table->timestamp('updated_at')->nullable();
            $table->string('updated_by', 64);
            $table->softDeletes();
            $table->string('court_judge_signature')->nullable();
            $table->string('court_master_signature')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('court_cases');
    }
};
