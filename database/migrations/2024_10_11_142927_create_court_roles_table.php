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
        Schema::create('court_roles', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->string('court_role', 2000);
            $table->dateTime('created_at')->nullable();
            $table->string('created_by', 64);
            $table->dateTime('updated_at')->nullable();
            $table->string('updated_by', 64);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('court_roles');
    }
};
