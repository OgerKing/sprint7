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
        Schema::create('pods', function (Blueprint $table) {
            $table->bigInteger('id')->primary();
            $table->char('s_type_cat', 1);
            $table->string('pod_name', 2000)->nullable();
            $table->string('pod_subfile', 15)->nullable();
            $table->string('pod_map_txt', 15)->nullable();
            $table->string('pod_tract_txt', 15)->nullable();
            $table->char('qtr_4th', 1)->nullable();
            $table->char('qtr_16th', 1)->nullable();
            $table->char('qtr_64th', 1)->nullable();
            $table->string('sub_sec_txt', 15)->nullable();
            $table->char('sec', 2)->nullable();
            $table->char('tws', 3)->nullable();
            $table->char('rng', 5)->nullable();
            $table->double('x')->nullable();
            $table->double('y')->nullable();
            $table->string('xy_datum', 5)->nullable();
            $table->string('xy_unit_of_measure', 5)->nullable();
            $table->char('zone', 1)->nullable();
            $table->string('map_id_desc', 60)->nullable();
            $table->string('f_photo_nbr', 20)->nullable();
            $table->smallInteger('well_define')->nullable();
            $table->dateTime('pod_loc_date', 6)->nullable();
            $table->dateTime('pod_loc_time', 6)->nullable();
            $table->string('plss_description', 250)->nullable();
            $table->smallInteger('crew_nbr')->nullable();
            $table->string('point_qual', 10)->nullable();
            $table->double('std_dev')->nullable();
            $table->string('pod_basin', 3)->nullable();
            $table->string('pod_nbr', 5)->nullable();
            $table->string('pod_suffix', 10)->nullable();
            $table->string('ose_file', 75)->nullable();
            $table->string('pod_hl_txt', 100)->nullable();
            $table->string('pod_field_no', 10)->nullable();
            $table->string('lot', 24)->nullable();
            $table->string('pod_location_description', 250)->nullable();
            $table->string('waters_pod_id', 15)->nullable();
            $table->bigInteger('s_id_access')->nullable();
            $table->unsignedTinyInteger('selected')->nullable();
            $table->char('map_qtr', 2)->nullable();
            $table->decimal('lat_deg', 8, 4)->nullable();
            $table->decimal('lat_min', 8, 4)->nullable();
            $table->decimal('lat_sec', 8, 4)->nullable();
            $table->decimal('lon_deg', 8, 4)->nullable();
            $table->decimal('lon_min', 8, 4)->nullable();
            $table->decimal('lon_sec', 8, 4)->nullable();
            $table->string('location_data_source', 2000)->nullable();
            $table->bigInteger('arcgis_processing_id')->nullable();
            $table->bigInteger('pod_type_id')->nullable();
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
        Schema::dropIfExists('pods');
    }
};
