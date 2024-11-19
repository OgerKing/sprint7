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
        Schema::table('defendant_documents', function (Blueprint $table) {
            $table->foreign(['document_type_id'], 'defendant_documents_ibfk_1')->references(['id'])->on('document_types')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['subfile_id'], 'defendant_documents_ibfk_2')->references(['id'])->on('subfiles')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('defendant_documents', function (Blueprint $table) {
            $table->dropForeign('defendant_documents_ibfk_1');
            $table->dropForeign('defendant_documents_ibfk_2');
        });
    }
};
