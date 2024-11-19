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
        Schema::create('ground_pods', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->bigInteger('arcgis_processing_id')->nullable();
            $table->bigInteger('pod_id');
            $table->string('ground_pod_source_text', 2000)->nullable();
            $table->string('pump_code', 6)->nullable();
            $table->string('power_source', 11)->nullable();
            $table->string('source_ug', 10)->nullable();
            $table->double('diameter_in')->nullable();
            $table->string('dom_map_label', 50)->nullable();
            $table->string('pod_wuc', 3)->nullable();
            $table->dateTime('log_filed', 6)->nullable();
            $table->unsignedTinyInteger('outside_adjudication_section')->nullable();
            $table->bigInteger('irrigation_id')->nullable();
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
        Schema::dropIfExists('ground_pods');
    }
};
