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
        Schema::table('persons', function (Blueprint $table) {
            $table->foreign(['person_address_id'], 'persons_ibfk_1')->references(['id'])->on('person_addresses')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['person_email_id'], 'persons_ibfk_2')->references(['id'])->on('person_emails')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['person_status_id'], 'persons_ibfk_3')->references(['id'])->on('person_statuses')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['person_telephone_id'], 'persons_ibfk_4')->references(['id'])->on('person_telephones')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['person_type_id'], 'persons_ibfk_5')->references(['id'])->on('person_types')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['authorized_agent_type_id'], 'persons_ibfk_6')->references(['id'])->on('authorized_agent_types')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['person_type_subtype_id'], 'persons_ibfk_7')->references(['id'])->on('person_type_subtypes')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('persons', function (Blueprint $table) {
            $table->dropForeign('persons_ibfk_1');
            $table->dropForeign('persons_ibfk_2');
            $table->dropForeign('persons_ibfk_3');
            $table->dropForeign('persons_ibfk_4');
            $table->dropForeign('persons_ibfk_5');
            $table->dropForeign('persons_ibfk_6');
            $table->dropForeign('persons_ibfk_7');
        });
    }
};
