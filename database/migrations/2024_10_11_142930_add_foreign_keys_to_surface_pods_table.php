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
        Schema::table('surface_pods', function (Blueprint $table) {
            $table->foreign(['arcgis_processing_id'], 'surface_pods_ibfk_1')->references(['id'])->on('arcgis_processing')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['pod_id'], 'surface_pods_ibfk_2')->references(['id'])->on('pods')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('surface_pods', function (Blueprint $table) {
            $table->dropForeign('surface_pods_ibfk_1');
            $table->dropForeign('surface_pods_ibfk_2');
        });
    }
};
