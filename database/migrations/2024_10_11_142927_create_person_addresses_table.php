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
        Schema::create('person_addresses', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->string('mailing_address_address_1', 50);
            $table->string('mailing_address_address_2', 50);
            $table->string('mailing_address_city', 50);
            $table->string('mailing_address_country', 5);
            $table->bigInteger('mailing_address_postal_code');
            $table->string('mailing_address_state', 2);
            $table->tinyInteger('mailing_address_verified')->nullable();
            $table->string('physical_address_address_1', 50);
            $table->string('physical_address_address_2', 50);
            $table->string('physical_address_city', 50);
            $table->string('physical_address_country', 5);
            $table->bigInteger('physical_address_postal_code');
            $table->string('physical_address_state', 2);
            $table->tinyInteger('physical_address_verified')->nullable();
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
        Schema::dropIfExists('person_addresses');
    }
};
