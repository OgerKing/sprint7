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
        Schema::create('court_personnel', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->bigInteger('court_role_id')->index('idx_cp_court_role');
            $table->bigInteger('court_id')->index('idx_cp_court');
            $table->string('first_name', 64);
            $table->string('last_name', 64);
            $table->string('middle_initial', 1)->nullable();
            $table->string('signature_image_url', 250)->nullable();
            $table->dateTime('created_at')->nullable();
            $table->string('created_by', 64);
            $table->dateTime('updated_at')->nullable();
            $table->string('updated_by', 64);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('court_personnel');
    }
};
