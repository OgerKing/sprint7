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
        Schema::create('use_codes', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('use_code', 3);
            $table->string('use_description', 100);
            $table->integer('domestic');
            $table->integer('acres');
            $table->integer('use_type_nbr');
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
        Schema::dropIfExists('use_codes');
    }
};
