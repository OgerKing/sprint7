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
        Schema::create('pou_statuses', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->string('pou_status_code', 5);
            $table->string('pou_status_description', 64);
            $table->tinyInteger('display_line')->nullable();
            $table->tinyInteger('display_summary')->nullable();
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
        Schema::dropIfExists('pou_statuses');
    }
};
