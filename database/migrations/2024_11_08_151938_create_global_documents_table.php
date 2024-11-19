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
        Schema::create('global_documents', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->bigInteger('adjudication_id')->nullable()->index();
            $table->string('global_document_title', 300)->nullable();
            $table->dateTime('document_filing_date')->nullable();
            $table->string('attachment_URL', 200)->nullable();
            $table->string('attachment_file_path', 200)->nullable();
            $table->bigInteger('global_document_type_id')->nullable()->index();
            $table->string('docket_id', 10)->nullable();
            $table->string('global_desc', 2000)->nullable();
            $table->bigInteger('global_id_access')->nullable();
            $table->dateTime('is_deleted')->nullable();
            $table->timestamp('created_at')->nullable();
            $table->string('created_by', 64)->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->string('updated_by', 64)->nullable();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('global_documents');
    }
};
