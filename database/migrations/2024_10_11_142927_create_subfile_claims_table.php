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
        Schema::create('subfile_claims', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->bigInteger('subfile_id')->index('subfile_id');
            $table->string('claim_title', 100)->nullable();
            $table->bigInteger('claim_type_id')->nullable()->index('claim_type_id');
            $table->bigInteger('claim_status_id')->nullable()->index('claim_status_id');
            $table->bigInteger('claim_person')->nullable();
            $table->timestamp('claim_open_date')->nullable();
            $table->timestamp('claim_close_date')->nullable();
            $table->bigInteger('claim_resolution_id')->nullable()->index('claim_resolution_id');
            $table->boolean('court_eo')->nullable();
            $table->bigInteger('resources_id')->nullable()->index('resources_id');
            $table->bigInteger('attorney_id')->nullable()->index('attorney_id');
            $table->string('subfile_claim_explanation', 4000)->nullable();
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
        Schema::dropIfExists('subfile_claims');
    }
};
