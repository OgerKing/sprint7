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
        Schema::create('hydrographic_document_persons', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->bigInteger('hydrographic_document_id')->index('hdp_hydrographic_document_id_index');
            $table->bigInteger('person_id')->index('hdp_person_id_index');
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
        Schema::dropIfExists('hydrographic_document_persons');
    }
};
