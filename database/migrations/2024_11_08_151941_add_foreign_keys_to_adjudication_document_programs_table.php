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
        Schema::table('adjudication_document_programs', function (Blueprint $table) {
            $table->foreign(['adjudication_id'], 'adjudication_document_programs_ibfk_1')->references(['id'])->on('adjudications')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['adjudication_section_type_id'], 'adjudication_document_programs_ibfk_10')->references(['id'])->on('adjudication_section_types')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['bureau_id'], 'adjudication_document_programs_ibfk_2')->references(['id'])->on('bureaus')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['court_id'], 'adjudication_document_programs_ibfk_3')->references(['id'])->on('courts')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['document_type_id'], 'adjudication_document_programs_ibfk_4')->references(['id'])->on('document_types')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['adjudication_status_id'], 'adjudication_document_programs_ibfk_5')->references(['id'])->on('adjudication_statuses')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['adjudication_document_id'], 'adjudication_document_programs_ibfk_6')->references(['id'])->on('adjudication_documents')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['court_case_id'], 'adjudication_document_programs_ibfk_7')->references(['id'])->on('court_cases')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['adjudication_sections_id'], 'adjudication_document_programs_ibfk_8')->references(['id'])->on('adjudication_sections')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['adjudication_section_status_id'], 'adjudication_document_programs_ibfk_9')->references(['id'])->on('adjudication_section_statuses')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('adjudication_document_programs', function (Blueprint $table) {
            $table->dropForeign('adjudication_document_programs_ibfk_1');
            $table->dropForeign('adjudication_document_programs_ibfk_10');
            $table->dropForeign('adjudication_document_programs_ibfk_2');
            $table->dropForeign('adjudication_document_programs_ibfk_3');
            $table->dropForeign('adjudication_document_programs_ibfk_4');
            $table->dropForeign('adjudication_document_programs_ibfk_5');
            $table->dropForeign('adjudication_document_programs_ibfk_6');
            $table->dropForeign('adjudication_document_programs_ibfk_7');
            $table->dropForeign('adjudication_document_programs_ibfk_8');
            $table->dropForeign('adjudication_document_programs_ibfk_9');
        });
    }
};
