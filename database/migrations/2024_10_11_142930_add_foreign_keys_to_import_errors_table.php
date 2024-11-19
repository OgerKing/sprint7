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
        Schema::table('import_errors', function (Blueprint $table) {
            $table->foreign(['arcgis_processing_id'], 'import_errors_ibfk_1')->references(['id'])->on('arcgis_processing')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('import_errors', function (Blueprint $table) {
            $table->dropForeign('import_errors_ibfk_1');
        });
    }
};
