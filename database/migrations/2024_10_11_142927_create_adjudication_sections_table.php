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
        Schema::create('adjudication_sections', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->bigInteger('adjudication_id')->index();
            $table->string('adjudication_section_name', 250);
            $table->string('prefix', 10)->nullable();
            $table->bigInteger('adjudication_section_type_id')->index('adjudication_sections_document_type_id_index');
            $table->string('boundary_name', 50)->nullable();
            $table->bigInteger('adjudication_section_status_id')->index('adjudication_sections_status_id_index');
            $table->bigInteger('water_source_id')->nullable();
            $table->string('basin_section', 1)->nullable();
            $table->boolean('extra_sub_file_tab')->nullable();
            $table->boolean('show_estate')->nullable();
            $table->string('program', 50)->nullable();
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
        Schema::dropIfExists('adjudication_sections');
    }
};
