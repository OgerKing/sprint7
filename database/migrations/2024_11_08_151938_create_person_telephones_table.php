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
        Schema::create('person_telephones', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->string('primary_person_telephone_anumber', 24);
            $table->tinyInteger('primary_person_telephone_number_verified')->nullable();
            $table->string('secondary_person_telephone_number', 24);
            $table->bigInteger('secondary_person_telephone_number_verified');
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
        Schema::dropIfExists('person_telephones');
    }
};
