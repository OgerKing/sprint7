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
        Schema::table('pou_non_irrigations', function (Blueprint $table) {
            $table->foreign(['pou_id'], 'pou_non_irrigations_ibfk_1')->references(['id'])->on('pous')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pou_non_irrigations', function (Blueprint $table) {
            $table->dropForeign('pou_non_irrigations_ibfk_1');
        });
    }
};
