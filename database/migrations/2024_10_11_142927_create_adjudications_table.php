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
        Schema::create('adjudications', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->string('adjudication_name', 100);
            $table->string('adjudication_nickname', 50)->nullable();
            $table->bigInteger('bureau_id')->index();
            $table->bigInteger('adjudication_status_id')->index('adjudication_district_id_index');
            $table->bigInteger('adjudication_district_id')->index('fk_adjs_district');
            $table->string('coordinate_system', 24)->nullable();
            $table->string('adjudication_boundary_map_link', 100)->nullable();
            $table->string('hydrographic_survey_description', 2000)->nullable();
            $table->string('prefix', 10)->nullable();
            $table->boolean('mapping_zone_central')->default(false);
            $table->boolean('mapping_zone_east')->default(false);
            $table->boolean('mapping_zone_west')->default(false);
            $table->timestamp('created_at')->nullable();
            $table->string('created_by', 64);
            $table->timestamp('updated_at')->nullable();
            $table->string('updated_by', 64);
            $table->softDeletes();

            $table->index(['adjudication_status_id'], 'adjudication_status_id_index');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('adjudications');
    }
};
