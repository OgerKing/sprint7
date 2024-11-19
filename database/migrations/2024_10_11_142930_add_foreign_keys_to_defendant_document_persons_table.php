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
        Schema::table('defendant_document_persons', function (Blueprint $table) {
            $table->foreign(['defendant_document_id'], 'defendant_document_persons_ibfk_1')->references(['id'])->on('defendant_documents')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['person_id'], 'defendant_document_persons_ibfk_2')->references(['id'])->on('persons')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('defendant_document_persons', function (Blueprint $table) {
            $table->dropForeign('defendant_document_persons_ibfk_1');
            $table->dropForeign('defendant_document_persons_ibfk_2');
        });
    }
};
