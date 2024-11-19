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
        Schema::table('missing_pouirrs', function (Blueprint $table) {
            $table->foreign(['pou_irrigation_id'], 'missing_pouirrs_ibfk_1')->references(['id'])->on('pou_irrigations')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['arcgis_processing_id'], 'missing_pouirrs_ibfk_2')->references(['id'])->on('arcgis_processing')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['bureau_id'], 'missing_pouirrs_ibfk_3')->references(['id'])->on('bureaus')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['city_id'], 'missing_pouirrs_ibfk_4')->references(['id'])->on('cities')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['county_id'], 'missing_pouirrs_ibfk_5')->references(['id'])->on('counties')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['court_id'], 'missing_pouirrs_ibfk_6')->references(['id'])->on('courts')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['grant_id'], 'missing_pouirrs_ibfk_7')->references(['id'])->on('grants')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['pou_comments_id'], 'missing_pouirrs_ibfk_8')->references(['id'])->on('pou_comments')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['pou_status_id'], 'missing_pouirrs_ibfk_9')->references(['id'])->on('pou_statuses')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('missing_pouirrs', function (Blueprint $table) {
            $table->dropForeign('missing_pouirrs_ibfk_1');
            $table->dropForeign('missing_pouirrs_ibfk_2');
            $table->dropForeign('missing_pouirrs_ibfk_3');
            $table->dropForeign('missing_pouirrs_ibfk_4');
            $table->dropForeign('missing_pouirrs_ibfk_5');
            $table->dropForeign('missing_pouirrs_ibfk_6');
            $table->dropForeign('missing_pouirrs_ibfk_7');
            $table->dropForeign('missing_pouirrs_ibfk_8');
            $table->dropForeign('missing_pouirrs_ibfk_9');
        });
    }
};
