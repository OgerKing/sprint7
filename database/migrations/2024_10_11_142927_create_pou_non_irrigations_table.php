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
        Schema::create('pou_non_irrigations', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->bigInteger('pou_id')->index('fk_pou_non_irrigations_pous');
            $table->bigInteger('arcgis_processing_id')->nullable();
            $table->string('map_id_desc', 60)->nullable();
            $table->char('zone', 1)->nullable();
            $table->bigInteger('r_id_access')->nullable();
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
        Schema::dropIfExists('pou_non_irrigations');
    }
};
