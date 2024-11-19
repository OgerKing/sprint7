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
        Schema::create('pod_name_histories', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->bigInteger('pod_id');
            $table->string('pod_basin', 3);
            $table->string('pod_nbr', 5);
            $table->string('pod_suffix', 10);
            $table->timestamp('end_date')->nullable();
            $table->tinyInteger('proposed')->nullable();
            $table->bigInteger('s_id_access');
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
        Schema::dropIfExists('pod_name_histories');
    }
};
