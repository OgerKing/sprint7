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
        Schema::create('person_emails', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->string('primary_contact_email', 50);
            $table->tinyInteger('primary_contact_email_verified')->nullable();
            $table->string('secondary_contact_email', 50);
            $table->bigInteger('secondary_contact_email_verified');
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
        Schema::dropIfExists('person_emails');
    }
};
