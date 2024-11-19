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
        Schema::table('global_document_persons', function (Blueprint $table) {
            $table->foreign(['global_document_id'], 'global_document_persons_ibfk_1')->references(['id'])->on('global_documents')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['person_id'], 'global_document_persons_ibfk_2')->references(['id'])->on('persons')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('global_document_persons', function (Blueprint $table) {
            $table->dropForeign('global_document_persons_ibfk_1');
            $table->dropForeign('global_document_persons_ibfk_2');
        });
    }
};
