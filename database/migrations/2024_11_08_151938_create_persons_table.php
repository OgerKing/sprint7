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
        Schema::create('persons', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->bigInteger('person_type_id')->index('idx_persons_person_type');
            $table->bigInteger('person_type_subtype_id')->index('idx_person_type_subtypes');
            $table->bigInteger('authorized_agent_type_id')->index('idx_authorized_agent_type_id');
            $table->string('first_name', 50);
            $table->string('middle_name', 50)->nullable();
            $table->string('last_name', 50);
            $table->string('suffix', 15)->nullable();
            $table->dateTime('person_start_date')->nullable();
            $table->dateTime('person_end_date')->nullable();
            $table->bigInteger('person_status_id')->index('idx_persons_person_status');
            $table->tinyInteger('is_deceased')->nullable();
            $table->tinyInteger('verified')->nullable();
            $table->bigInteger('person_address_id')->nullable()->index('idx_persons_person_address');
            $table->bigInteger('person_email_id')->nullable()->index('idx_persons_person_email');
            $table->bigInteger('person_telephone_id')->nullable()->index('idx_persons_person_telephone');
            $table->string('special_handling_instructions', 250)->nullable();
            $table->string('department', 50)->nullable();
            $table->string('division', 50)->nullable();
            $table->string('entity_name', 64)->nullable();
            $table->dateTime('created_at')->nullable();
            $table->string('created_by', 64);
            $table->dateTime('updated_at')->nullable();
            $table->string('updated_by', 64);
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('persons');
    }
};
