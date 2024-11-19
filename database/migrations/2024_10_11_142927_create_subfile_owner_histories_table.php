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
        Schema::create('subfile_owner_histories', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->timestamps();
            $table->bigInteger('contact_email_id')->index('contact_email_id');
            $table->bigInteger('person_telephone_id')->index('person_telephone_id');
            $table->string('created_by', 64);
            $table->bigInteger('defendant_type_id')->index('defendant_type_id');
            $table->bigInteger('person_address_id')->index('person_address_id');
            $table->bigInteger('person_id')->index('person_id');
            $table->bigInteger('person_interest_type_id')->index('person_interest_type_id');
            $table->bigInteger('prev_oid');
            $table->bigInteger('subfile_persons_id')->index('subfile_persons_id');
            $table->dateTime('trans_date');
            $table->bigInteger('transaction_id');
            $table->string('updated_by', 64);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subfile_owner_histories');
    }
};
