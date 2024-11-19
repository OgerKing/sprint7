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
        Schema::table('quarter_report_sort_order', function (Blueprint $table) {
            $table->foreign(['adjudications_section_id'], 'quarter_report_sort_order_ibfk_1')->references(['id'])->on('adjudication_sections')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('quarter_report_sort_order', function (Blueprint $table) {
            $table->dropForeign('quarter_report_sort_order_ibfk_1');
        });
    }
};
