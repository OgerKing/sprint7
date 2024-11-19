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
        Schema::table('stream_to_basin_configurations', function (Blueprint $table) {
            $table->foreign(['stream_system_id'], 'stream_to_basin_configurations_ibfk_1')->references(['id'])->on('stream_systems')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['water_basin_id'], 'stream_to_basin_configurations_ibfk_2')->references(['id'])->on('water_basins')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('stream_to_basin_configurations', function (Blueprint $table) {
            $table->dropForeign('stream_to_basin_configurations_ibfk_1');
            $table->dropForeign('stream_to_basin_configurations_ibfk_2');
        });
    }
};
