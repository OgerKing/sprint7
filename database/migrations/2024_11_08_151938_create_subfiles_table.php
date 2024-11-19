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
        Schema::create('subfiles', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->bigInteger('adjudication_section_id')->index('sub_adjudication_section_id');
            $table->bigInteger('subfile_adjudication_note_id')->nullable()->index('sub_subfile_adjudication_note_id');
            $table->bigInteger('ose_work_summary_note_id')->nullable()->index('sub_ose_work_summary_note_id');
            $table->smallInteger('basin_nbr_hl')->nullable();
            $table->string('basin_section_hl', 5)->nullable();
            $table->double('batch')->nullable();
            $table->bigInteger('file_location_id')->nullable()->index('sub_file_location_id');
            $table->bigInteger('prev_sub_id')->nullable();
            $table->dateTime('print_file')->nullable();
            $table->boolean('selected')->nullable();
            $table->bigInteger('sub_file_assigned_ose_attorney_person_id')->nullable();
            $table->dateTime('sub_file_end_date')->nullable();
            $table->string('sub_file_group', 250)->nullable();
            $table->string('sub_file_hl_sfx', 10)->nullable();
            $table->string('sub_file_hl_txt', 60)->nullable();
            $table->integer('sub_file_map_nbr')->nullable();
            $table->bigInteger('sub_file_parent_id')->nullable();
            $table->decimal('sub_file_sort', 7, 3)->nullable();
            $table->dateTime('sub_file_start_date')->nullable();
            $table->integer('sub_file_type_nbr')->nullable();
            $table->string('sub_file_var_sort', 20)->nullable();
            $table->bigInteger('sub_id_access')->nullable();
            $table->string('sub_unk_own', 60)->nullable();
            $table->bigInteger('subfile_adjudication_status_id')->nullable()->index('sub_subfile_adjudication_status_id');
            $table->integer('verified')->nullable();
            $table->dateTime('wrats_status_date')->nullable();
            $table->string('wrats_status_doc', 50)->nullable();
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
        Schema::dropIfExists('subfiles');
    }
};
