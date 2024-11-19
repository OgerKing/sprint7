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
        Schema::create('document_definitions', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->string('created_by', 64);
            $table->smallInteger('def_doc_sort');
            $table->bigInteger('def_doc_status');
            $table->string('definition', 6);
            $table->string('document_definition_name', 50);
            $table->string('updated_by', 64);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('document_definitions');
    }
};
