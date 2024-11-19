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
        Schema::create('subfile_court_cases', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->bigInteger('subfile_id')->index('ccs_subfile_index');
            $table->bigInteger('court_case_id')->index('ccs_court_cases_index');
            $table->bigInteger('parent_court_case_id');
            $table->string('case_number', 50)->nullable();
            $table->date('court_case_open_date')->nullable();
            $table->date('court_case_close_date')->nullable();
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
        Schema::dropIfExists('subfile_court_cases');
    }
};
