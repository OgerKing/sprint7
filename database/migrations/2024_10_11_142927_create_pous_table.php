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
        Schema::create('pous', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->bigInteger('arcgis_processing_id')->nullable()->index('key_pou_arcgis');
            $table->bigInteger('pou_status_id')->nullable()->index('pou_status_id_index');
            $table->string('subsec_txt', 15)->nullable();
            $table->string('pou_map_txt', 15)->nullable();
            $table->string('pou_tract_txt', 15)->nullable();
            $table->integer('x')->nullable();
            $table->integer('y')->nullable();
            $table->string('xy_unit_of_measure', 5)->nullable();
            $table->string('alt_location_hl')->nullable();
            $table->integer('no_right')->nullable();
            $table->string('pla_qtr_4th', 10)->nullable();
            $table->string('pla_qtr_16th', 10)->nullable();
            $table->string('pla_qtr_64th', 10)->nullable();
            $table->string('pla_sec', 10)->nullable();
            $table->string('pla_tws', 10)->nullable();
            $table->string('pla_rng', 10)->nullable();
            $table->decimal('rev_hs_acres', 8, 4)->nullable();
            $table->string('plss_description')->nullable();
            $table->string('lot')->nullable();
            $table->integer('outside_adjudication_section')->nullable();
            $table->timestamp('created_at')->nullable();
            $table->string('created_by', 64);
            $table->timestamp('updated_at')->nullable();
            $table->string('updated_by', 64);
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pous');
    }
};
