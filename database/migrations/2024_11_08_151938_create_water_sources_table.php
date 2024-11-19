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
        Schema::create('water_sources', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->string('water_source_code', 5);
            $table->string('water_source_description', 64);
            $table->bigInteger('water_source_sort')->nullable();
            $table->timestamp('created_at')->nullable();
            $table->string('created_by', 64);
            $table->timestamp('updated_at')->nullable();
            $table->string('updated_by', 64);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('water_sources');
    }
};
