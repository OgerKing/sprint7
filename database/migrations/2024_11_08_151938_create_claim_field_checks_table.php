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
        Schema::create('claim_field_checks', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->string('field_work_code', 5)->index();
            $table->bigInteger('field_work_id')->index();
            $table->string('fld_work_notes', 2000);
            $table->dateTime('fld_wrk_date');
            $table->bigInteger('fld_wrk_id')->index();
            $table->bigInteger('resource_id')->index();
            $table->bigInteger('sub_id')->index();
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
        Schema::dropIfExists('claim_field_checks');
    }
};
