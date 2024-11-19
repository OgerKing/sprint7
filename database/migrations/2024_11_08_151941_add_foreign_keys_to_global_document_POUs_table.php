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
        Schema::table('global_document_POUs', function (Blueprint $table) {
            $table->foreign(['global_document_id'], 'fk_gdpou_global_document_id')->references(['id'])->on('global_documents')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['POU_id'], 'fk_gdpou_pou_id')->references(['id'])->on('pous')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('global_document_POUs', function (Blueprint $table) {
            $table->dropForeign('fk_gdpou_global_document_id');
            $table->dropForeign('fk_gdpou_pou_id');
        });
    }
};
