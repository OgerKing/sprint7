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
        Schema::create('surface_zones', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->double('cir');
            $table->double('cir_star');
            $table->double('pdr');
            $table->double('pdr_star');
            $table->double('fdr');
            $table->double('fdr_star');
            $table->string('surf_zone_description', 256);
            $table->double('evap_loss');
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
        Schema::dropIfExists('surface_zones');
    }
};
