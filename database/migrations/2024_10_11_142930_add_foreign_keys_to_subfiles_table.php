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
        Schema::table('subfiles', function (Blueprint $table) {
            $table->foreign(['subfile_adjudication_note_id'], 'subfiles_ibfk_1')->references(['id'])->on('subfile_adjudication_notes')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['adjudication_section_id'], 'subfiles_ibfk_2')->references(['id'])->on('adjudication_sections')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['subfile_adjudication_status_id'], 'subfiles_ibfk_3')->references(['id'])->on('subfile_adjudication_statuses')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['file_location_id'], 'subfiles_ibfk_4')->references(['id'])->on('file_locations')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['ose_work_summary_note_id'], 'subfiles_ibfk_5')->references(['id'])->on('subfile_ose_work_summary_notes')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('subfiles', function (Blueprint $table) {
            $table->dropForeign('subfiles_ibfk_1');
            $table->dropForeign('subfiles_ibfk_2');
            $table->dropForeign('subfiles_ibfk_3');
            $table->dropForeign('subfiles_ibfk_4');
            $table->dropForeign('subfiles_ibfk_5');
        });
    }
};
