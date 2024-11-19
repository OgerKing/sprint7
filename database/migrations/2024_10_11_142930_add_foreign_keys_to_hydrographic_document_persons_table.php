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
        Schema::table('hydrographic_document_persons', function (Blueprint $table) {
            $table->foreign(['person_id'], 'hydrographic_document_persons_ibfk_1')->references(['id'])->on('persons')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['hydrographic_document_id'], 'hydrographic_document_persons_ibfk_2')->references(['id'])->on('hydrographic_documents')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('hydrographic_document_persons', function (Blueprint $table) {
            $table->dropForeign('hydrographic_document_persons_ibfk_1');
            $table->dropForeign('hydrographic_document_persons_ibfk_2');
        });
    }
};
