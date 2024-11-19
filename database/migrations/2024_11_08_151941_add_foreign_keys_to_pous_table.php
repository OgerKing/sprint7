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
        Schema::table('pous', function (Blueprint $table) {
            $table->foreign(['arcgis_processing_id'], 'pous_ibfk_1')->references(['id'])->on('arcgis_processing')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['pou_status_id'], 'pous_ibfk_2')->references(['id'])->on('pou_statuses')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pous', function (Blueprint $table) {
            $table->dropForeign('pous_ibfk_1');
            $table->dropForeign('pous_ibfk_2');
        });
    }
};
