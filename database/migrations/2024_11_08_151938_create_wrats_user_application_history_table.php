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
        Schema::create('wrats_user_application_history', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->string('label', 64);
            $table->longText('parameters');
            $table->longText('path');
            $table->longText('record_type');
            $table->bigInteger('users_id')->index();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wrats_user_application_history');
    }
};
