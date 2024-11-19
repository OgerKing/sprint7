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
        Schema::create('pou_water_rights', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->bigInteger('pou_id')->index();
            $table->bigInteger('water_right_id')->index();
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
        Schema::dropIfExists('pou_water_rights');
    }
};
