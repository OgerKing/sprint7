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
        Schema::create('adjudication_document_programs', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->bigInteger('court_case_id')->index();
            $table->bigInteger('adjudication_document_id')->index();
            $table->bigInteger('document_type_id')->index('idx_adjhyddoctyp');
            $table->bigInteger('adjudication_id')->index();
            $table->bigInteger('adjudication_section_status_id')->index('idx_adjsecstat');
            $table->bigInteger('adjudication_section_type_id')->index('idx_adjsectyp211');
            $table->bigInteger('adjudication_sections_id')->index('idx_adjsecs5654');
            $table->bigInteger('adjudication_status_id')->index();
            $table->bigInteger('bureau_id')->index();
            $table->bigInteger('court_id')->index();
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
        Schema::dropIfExists('adjudication_document_programs');
    }
};
