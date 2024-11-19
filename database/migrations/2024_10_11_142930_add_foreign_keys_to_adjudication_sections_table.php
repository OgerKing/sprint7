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
        Schema::table('adjudication_sections', function (Blueprint $table) {
            $table->foreign(['adjudication_id'], 'fk_adjudication_sections_adjudication_id')->references(['id'])->on('adjudications')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['adjudication_section_type_id'], 'fk_adjudication_sections_adjudication_section_type_id')->references(['id'])->on('adjudication_section_types')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['adjudication_section_status_id'], 'fk_adjudication_sections_status_id')->references(['id'])->on('adjudication_section_statuses')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('adjudication_sections', function (Blueprint $table) {
            $table->dropForeign('fk_adjudication_sections_adjudication_id');
            $table->dropForeign('fk_adjudication_sections_adjudication_section_type_id');
            $table->dropForeign('fk_adjudication_sections_status_id');
        });
    }
};
