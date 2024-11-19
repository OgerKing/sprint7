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
        Schema::create('water_right_uses', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->string('water_right_use_code', 3);
            $table->string('water_right_use_description', 128);
            $table->bigInteger('domestic');
            $table->bigInteger('acres');
            $table->bigInteger('use_type_nbr');
            $table->tinyInteger('old_only')->nullable();
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
        Schema::dropIfExists('water_right_uses');
    }
};
