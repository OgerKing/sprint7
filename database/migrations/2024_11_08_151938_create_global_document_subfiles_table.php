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
        Schema::create('global_document_subfiles', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->bigInteger('global_document_id')->index('gds_global_document_id_index');
            $table->bigInteger('subfile_id')->index('gds_subfile_id_index');
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
        Schema::dropIfExists('global_document_subfiles');
    }
};
