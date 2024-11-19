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
        Schema::table('adjudications', function (Blueprint $table) {
            $table->foreign(['adjudication_status_id'], 'adjudications_ibfk_1')->references(['id'])->on('adjudication_statuses')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['bureau_id'], 'adjudications_ibfk_2')->references(['id'])->on('bureaus')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['adjudication_district_id'], 'adjudications_ibfk_3')->references(['id'])->on('adjudication_districts')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('adjudications', function (Blueprint $table) {
            $table->dropForeign('adjudications_ibfk_1');
            $table->dropForeign('adjudications_ibfk_2');
            $table->dropForeign('adjudications_ibfk_3');
        });
    }
};
