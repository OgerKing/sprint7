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
        Schema::create('pod_comment_types', function (Blueprint $table) {
            $table->bigInteger('id')->primary();
            $table->string('pod_comment_type', 50);
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
        Schema::dropIfExists('pod_comment_types');
    }
};
