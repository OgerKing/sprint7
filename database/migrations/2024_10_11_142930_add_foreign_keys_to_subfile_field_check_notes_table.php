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
        Schema::table('subfile_field_check_notes', function (Blueprint $table) {
            //$table->foreign(['subfile_id'], 'subfile_field_check_notes_ibfk_7')->references(['id'])->on('subfiles')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('subfile_field_check_notes', function (Blueprint $table) {
            $table->dropForeign('subfile_field_check_notes_ibfk_1');
        });
    }
};
