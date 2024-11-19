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
        Schema::create('person_aliases', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->bigInteger('person_id')->index('idx_person_aliases_person_id');
            $table->bigInteger('person_alias_type_id')->index();
            $table->string('entity_name', 64);
            $table->string('first_name', 20);
            $table->string('last_name', 50);
            $table->string('middle_name', 20);
            $table->timestamps();
            $table->string('created_by', 64);
            $table->string('updated_by', 64);
            $table->softDeletes();

            $table->index(['person_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('person_aliases');
    }
};
