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
        Schema::create('pou_irrigations', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->bigInteger('pou_id')->nullable()->index('pouirr_pou');
            $table->bigInteger('arcgis_processing_id')->nullable()->index('pouirr_arcgis');
            $table->bigInteger('pou_status_id')->nullable()->index('pouirr_poustatus');
            $table->bigInteger('bureau_id')->nullable()->index('pouirrs_bureau');
            $table->string('county_id', 18)->nullable();
            $table->bigInteger('grant_id')->nullable()->index('pouirr_grant');
            $table->integer('area')->nullable();
            $table->integer('perimeter')->nullable();
            $table->string('mult', 5)->nullable();
            $table->integer('ia_no')->nullable();
            $table->string('ia_id', 10)->nullable();
            $table->string('sub_sec_txt', 15)->nullable();
            $table->string('pou_hl_txt', 250)->nullable();
            $table->integer('crop_field')->nullable();
            $table->integer('crop_code')->nullable();
            $table->string('irr_sys_type', 1)->nullable();
            $table->string('lo_code', 1)->nullable();
            $table->string('o_photo_no', 10)->nullable();
            $table->string('map_nr_acr', 7)->nullable();
            $table->bigInteger('pl_id_access')->nullable();
            $table->bigInteger('basin_nbr_hl')->nullable();
            $table->string('map_qtr', 2)->nullable();
            $table->string('crop_irrigation_requirement', 1)->nullable();
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
        Schema::dropIfExists('pou_irrigations');
    }
};
