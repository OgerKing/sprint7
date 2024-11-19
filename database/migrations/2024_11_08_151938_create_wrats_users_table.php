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
        Schema::create('wrats_users', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->string('ad_user_name', 64);
            $table->string('created_by', 64);
            $table->string('email');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('updated_by', 64);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wrats_users');
    }
};
