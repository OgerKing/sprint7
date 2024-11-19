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
        Schema::create('adjudication_documents', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->bigInteger('subfile_id')->index();
            $table->string('adjudication_document_code', 10);
            $table->string('adjudication_document_title', 100);
            $table->bigInteger('document_type_id')->index();
            $table->dateTime('document_filing_date')->nullable();
            $table->string('attachment_URL', 200)->nullable();
            $table->string('attachment_file_path', 200)->nullable();
            $table->dateTime('is_deleted')->nullable();
            $table->timestamp('created_at')->nullable();
            $table->string('created_by', 64);
            $table->timestamp('updated_at')->nullable();
            $table->string('updated_by', 64);
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('adjudication_documents');
    }
};
