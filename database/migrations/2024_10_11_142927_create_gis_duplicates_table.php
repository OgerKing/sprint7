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
        Schema::create('gis_duplicates', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->string('bureau', 27);
            $table->integer('dupeid');
            $table->bigInteger('number');
            $table->string('table_type', 27);
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
        Schema::dropIfExists('gis_duplicates');
    }
};
