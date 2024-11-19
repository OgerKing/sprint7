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
        Schema::table('global_documents', function (Blueprint $table) {
            $table->foreign(['global_document_type_id'], 'global_documents_ibfk_2')->references(['id'])->on('document_types')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('global_documents', function (Blueprint $table) {
            $table->dropForeign('global_documents_ibfk_2');
        });
    }
};
