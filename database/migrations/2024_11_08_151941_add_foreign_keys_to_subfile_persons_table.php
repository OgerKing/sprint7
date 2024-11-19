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
        Schema::table('subfile_persons', function (Blueprint $table) {
            $table->foreign(['authorized_agent_person_id'])->references(['id'])->on('persons')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['defendant_type_id'], 'subfile_persons_ibfk_1')->references(['id'])->on('defendant_types')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['person_interest_type_id'], 'subfile_persons_ibfk_2')->references(['id'])->on('person_interest_types')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['person_legal_interest_type_id'], 'subfile_persons_ibfk_3')->references(['id'])->on('person_legal_interest_types')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['person_id'], 'subfile_persons_ibfk_4')->references(['id'])->on('persons')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['subfile_id'], 'subfile_persons_ibfk_9')->references(['id'])->on('subfiles')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('subfile_persons', function (Blueprint $table) {
            $table->dropForeign('subfile_persons_authorized_agent_person_id_foreign');
            $table->dropForeign('subfile_persons_ibfk_1');
            $table->dropForeign('subfile_persons_ibfk_2');
            $table->dropForeign('subfile_persons_ibfk_3');
            $table->dropForeign('subfile_persons_ibfk_4');
            $table->dropForeign('subfile_persons_ibfk_9');
        });
    }
};
