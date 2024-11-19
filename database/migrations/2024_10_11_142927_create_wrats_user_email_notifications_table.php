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
        Schema::create('wrats_user_email_notifications', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->bigInteger('wrats_user_id')->index('wrats_user_id');
            $table->string('email_sent_address', 64);
            $table->dateTime('email_sent_at');
            $table->string('email_sent_subject', 64);
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
        Schema::dropIfExists('wrats_user_email_notifications');
    }
};
