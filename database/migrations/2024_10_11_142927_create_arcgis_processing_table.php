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
        Schema::create('arcgis_processing', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->bigInteger('adjudication_section_id')->index('arcgis_adjud_section_id');
            $table->bigInteger('access_gis')->nullable();
            $table->tinyInteger('gis')->nullable();
            $table->string('gis_dir', 100)->nullable();
            $table->dateTime('last_import')->nullable();
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
        Schema::dropIfExists('arcgis_processing');
    }
};
