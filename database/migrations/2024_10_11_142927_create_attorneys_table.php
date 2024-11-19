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
        Schema::create('attorneys', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->string('last_name', 64);
            $table->string('first_name', 64);
            $table->string('middle_Initial', 3)->nullable();
            $table->string('title', 50)->nullable();
            $table->string('firm', 100)->nullable();
            $table->string('firm_department', 100)->nullable();
            $table->string('office_address', 50)->nullable();
            $table->string('office_address2', 50)->nullable();
            $table->string('office_city', 50)->nullable();
            $table->string('office_state', 3)->nullable();
            $table->string('office_zip', 9)->nullable();
            $table->string('office_phone', 20)->nullable();
            $table->string('office_fax', 20)->nullable();
            $table->string('office_email', 100)->nullable();
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
        Schema::dropIfExists('attorneys');
    }
};
