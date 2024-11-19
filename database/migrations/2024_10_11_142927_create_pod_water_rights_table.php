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
        Schema::create('pod_water_rights', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->bigInteger('pod_id')->index();
            $table->bigInteger('water_right_id')->index();
            $table->double('acres_pri');
            $table->double('acre_ft_pri');
            $table->double('percent_cfs');
            $table->string('priority_date', 200)->nullable();
            $table->string('priority_date_text', 1000)->nullable();
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
        Schema::dropIfExists('pod_water_rights');
    }
};
