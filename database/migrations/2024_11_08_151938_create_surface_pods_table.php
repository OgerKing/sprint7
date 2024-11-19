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
        Schema::create('surface_pods', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->bigInteger('arcgis_processing_id')->index('sp_arcgis_process_id_index');
            $table->bigInteger('pod_id')->index('sp_pod_id_index');
            $table->string('ditch_name_hl', 50);
            $table->string('ditch_name_aka', 50);
            $table->string('surface_pod_source_text', 2000);
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
        Schema::dropIfExists('surface_pods');
    }
};
