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
        Schema::table('adjudication_documents', function (Blueprint $table) {
            $table->foreign(['subfile_id'], 'adjudication_documents_ibfk_2')->references(['id'])->on('subfiles')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['document_type_id'], 'fk_adjudication_documents_document_type_id')->references(['id'])->on('document_types')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('adjudication_documents', function (Blueprint $table) {
            $table->dropForeign('adjudication_documents_ibfk_2');
            $table->dropForeign('fk_adjudication_documents_document_type_id');
        });
    }
};
