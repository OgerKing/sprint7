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
        Schema::table('owner_comments', function (Blueprint $table) {
            $table->foreign(['contact_email_id'], 'owner_comments_ibfk_1')->references(['id'])->on('person_emails')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['person_id'], 'owner_comments_ibfk_2')->references(['id'])->on('persons')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['person_status_id'], 'owner_comments_ibfk_3')->references(['id'])->on('person_statuses')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['person_telephone_id'], 'owner_comments_ibfk_4')->references(['id'])->on('person_telephones')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['person_type_id'], 'owner_comments_ibfk_5')->references(['id'])->on('person_types')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('owner_comments', function (Blueprint $table) {
            $table->dropForeign('owner_comments_ibfk_1');
            $table->dropForeign('owner_comments_ibfk_2');
            $table->dropForeign('owner_comments_ibfk_3');
            $table->dropForeign('owner_comments_ibfk_4');
            $table->dropForeign('owner_comments_ibfk_5');
        });
    }
};
