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
        Schema::create('missing_pouirrs', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->double('acres');
            $table->double('area');
            $table->bigInteger('basin_nbr_hl');
            $table->bigInteger('bureau_id')->index();
            $table->bigInteger('city_id')->index();
            $table->string('comments', 250);
            $table->bigInteger('county_id')->index();
            $table->bigInteger('court_id')->index();
            $table->string('created_by', 64);
            $table->double('crop_code');
            $table->double('crop_field');
            $table->bigInteger('grant_id')->index();
            $table->string('ia_id', 10);
            $table->double('ia_no');
            $table->char('irr_sys_type', 1);
            $table->char('lo_code', 1);
            $table->string('map_nr_acr', 7);
            $table->char('map_qtr', 2);
            $table->string('mult', 5);
            $table->bigInteger('no_right');
            $table->string('o_photo_no', 10);
            $table->double('perimeter');
            $table->bigInteger('pl_id')->index();
            $table->bigInteger('pl_idaccess');
            $table->char('pla_qtr16th', 1);
            $table->char('pla_qtr_4th', 1);
            $table->char('pla_qtr_64th', 1);
            $table->char('pla_rng', 3);
            $table->char('pla_sec', 2);
            $table->char('pla_tws', 3);
            $table->bigInteger('pou_comments_id')->index();
            $table->string('pou_hl_txt', 250);
            $table->bigInteger('pou_irrigation_id')->index();
            $table->string('pou_map_txt', 15);
            $table->bigInteger('pou_status_id')->index();
            $table->string('pou_tract_txt', 15);
            $table->bigInteger('arcgis_processing_id')->index();
            $table->string('subsec_txt', 15);
            $table->string('updated_by', 64);
            $table->string('work_notes', 100);
            $table->double('x');
            $table->double('y');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('missing_pouirrs');
    }
};
