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
        Schema::table('hydrographic_documents', function (Blueprint $table) {
            $table->foreign(['document_type_id'])->references(['id'])->on('document_types')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['subfile_id'], 'hydrographic_documents_ibfk_2')->references(['id'])->on('subfiles')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('hydrographic_documents', function (Blueprint $table) {
            $table->dropForeign('hydrographic_documents_document_type_id_foreign');
            $table->dropForeign('hydrographic_documents_ibfk_2');
        });
    }
};
