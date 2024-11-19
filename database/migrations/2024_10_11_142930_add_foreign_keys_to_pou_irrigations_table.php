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
        Schema::table('pou_irrigations', function (Blueprint $table) {
            $table->foreign(['arcgis_processing_id'], 'pou_irrigations_ibfk_1')->references(['id'])->on('arcgis_processing')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['bureau_id'], 'pou_irrigations_ibfk_2')->references(['id'])->on('bureaus')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['grant_id'], 'pou_irrigations_ibfk_3')->references(['id'])->on('grants')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['pou_id'], 'pou_irrigations_ibfk_4')->references(['id'])->on('pous')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['pou_status_id'], 'pou_irrigations_ibfk_5')->references(['id'])->on('pou_statuses')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pou_irrigations', function (Blueprint $table) {
            $table->dropForeign('pou_irrigations_ibfk_1');
            $table->dropForeign('pou_irrigations_ibfk_2');
            $table->dropForeign('pou_irrigations_ibfk_3');
            $table->dropForeign('pou_irrigations_ibfk_4');
            $table->dropForeign('pou_irrigations_ibfk_5');
        });
    }
};
