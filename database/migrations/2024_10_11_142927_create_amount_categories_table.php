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
        Schema::create('amount_categories', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->string('amt_type_id', 5);
            $table->string('amt_type_desc', 50);
            $table->tinyInteger('amt_fdr')->nullable();
            $table->tinyInteger('amt_cir')->nullable();
            $table->tinyInteger('amt_pdr')->nullable();
            $table->tinyInteger('amt_txt')->nullable();
            $table->tinyInteger('amt_div_rt_hl')->nullable();
            $table->tinyInteger('amt_cfs')->nullable();
            $table->tinyInteger('amt_con_use')->nullable();
            $table->tinyInteger('amt_surf_area')->nullable();
            $table->tinyInteger('amt_depth')->nullable();
            $table->tinyInteger('amt_volume')->nullable();
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
        Schema::dropIfExists('amount_categories');
    }
};
