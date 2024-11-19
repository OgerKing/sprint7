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
        Schema::create('document_types', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->bigInteger('document_category_id')->index('document_types_category_id_index');
            $table->string('document_type_code', 6);
            $table->string('document_type_description', 250);
            $table->bigInteger('sort')->nullable();
            $table->dateTime('is_deleted')->nullable();
            $table->timestamp('created_at')->nullable();
            $table->string('created_by', 64);
            $table->timestamp('updated_at')->nullable();
            $table->string('updated_by', 64);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('document_types');
    }
};
