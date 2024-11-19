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
        Schema::create('defendant_types', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->string('created_by', 64);
            $table->string('defendant_type_description', 200);
            $table->string('updated_by', 64);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('defendant_types');
    }
};
