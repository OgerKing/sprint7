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
        Schema::create('owner_comments', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->string('comment', 4000);
            $table->bigInteger('contact_email_id')->index();
            $table->bigInteger('person_telephone_id')->index();
            $table->bigInteger('person_id')->index();
            $table->bigInteger('person_status_id')->index();
            $table->bigInteger('person_type_id')->index();
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
        Schema::dropIfExists('owner_comments');
    }
};
