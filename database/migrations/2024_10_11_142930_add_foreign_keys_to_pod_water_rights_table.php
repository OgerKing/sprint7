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
        Schema::table('pod_water_rights', function (Blueprint $table) {
            $table->foreign(['pod_id'])->references(['id'])->on('pods')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['water_right_id'])->references(['id'])->on('water_rights')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pod_water_rights', function (Blueprint $table) {
            $table->dropForeign('pod_water_rights_pod_id_foreign');
            $table->dropForeign('pod_water_rights_water_right_id_foreign');
        });
    }
};
