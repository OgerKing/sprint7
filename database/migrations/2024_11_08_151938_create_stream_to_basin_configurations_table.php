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
        Schema::create('stream_to_basin_configurations', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->bigInteger('stream_system_id')->index('sbc_stream_system_id');
            $table->bigInteger('water_basin_id')->index('water_basin_id');
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
        Schema::dropIfExists('stream_to_basin_configurations');
    }
};
