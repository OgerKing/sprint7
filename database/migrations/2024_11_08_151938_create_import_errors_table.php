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
        Schema::create('import_errors', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->dateTime('error_datetime');
            $table->string('error_description', 500);
            $table->bigInteger('arcgis_processing_id')->index('import_errors_arcgis_procss_id_index');
            $table->string('table_name', 50);
            $table->string('user_name', 50);
            $table->timestamp('created_at')->nullable();
            $table->string('created_by', 64);
            $table->timestamp('updated_at')->nullable();
            $table->string('updated_by', 64);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('import_errors');
    }
};
