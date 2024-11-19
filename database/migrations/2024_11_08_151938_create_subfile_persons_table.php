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
        Schema::create('subfile_persons', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->bigInteger('subfile_id')->index('idx_subfile_persons_subfile');
            $table->bigInteger('person_id')->index('idx_subfile_persons_persons');
            $table->bigInteger('authorized_agent_person_id')->nullable()->index('subfile_persons_authorized_agent_person_id_foreign');
            $table->dateTime('person_open_date')->nullable();
            $table->dateTime('person_close_date')->nullable();
            $table->bigInteger('person_status');
            $table->bigInteger('person_type');
            $table->string('category', 2)->nullable();
            $table->bigInteger('cert_mail')->nullable();
            $table->string('cid_no', 100)->nullable();
            $table->bigInteger('person_email')->nullable();
            $table->bigInteger('person_telephone')->nullable();
            $table->string('mailing_address_address1', 50)->nullable();
            $table->string('mailing_address_address2', 50)->nullable();
            $table->string('mailing_address_city', 50)->nullable();
            $table->string('mailing_address_county', 5)->nullable();
            $table->bigInteger('mailing_address_postal_code')->nullable();
            $table->string('mailing_address_state', 2)->nullable();
            $table->string('attorney_last_name', 64)->nullable();
            $table->string('attorney_first_name', 64)->nullable();
            $table->string('attorney_middle_initial', 1)->nullable();
            $table->string('attorney_title', 50)->nullable();
            $table->string('attorney_firm', 100)->nullable();
            $table->tinyInteger('is_authorized_agent')->nullable();
            $table->integer('is_permittee')->nullable();
            $table->integer('is_defendant')->nullable();
            $table->bigInteger('defendant_type_id')->nullable()->index('idx_subfile_persons_defendant_types');
            $table->string('owner_set', 25);
            $table->bigInteger('person_interest_type_id')->index('idx_subfile_persons_person_interest_type');
            $table->bigInteger('person_legal_interest_type_id')->index('idx_subfile_persons_person_legal_interest_type');
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
        Schema::dropIfExists('subfile_persons');
    }
};
