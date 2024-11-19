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
        Schema::create('pod_uses', function (Blueprint $table) {
            $table->bigInteger('id')->primary();
            $table->string('use_code', 3);
            $table->string('description', 1500);
            $table->dateTime('created_at', 6)->nullable();
            $table->string('created_by', 64);
            $table->dateTime('updated_at', 6)->nullable();
            $table->string('updated_by', 64);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pod_uses');
    }
};
