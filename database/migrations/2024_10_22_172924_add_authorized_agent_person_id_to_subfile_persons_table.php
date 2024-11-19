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
            Schema::table('subfile_persons', function (Blueprint $table) {
                $table->bigInteger('authorized_agent_person_id')->nullable()->after('person_id');

                $table->foreign('authorized_agent_person_id')
                    ->references('id')->on('persons')
                    ->onUpdate('no action')->onDelete('no action');
            });

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('subfile_persons', function (Blueprint $table) {
            $table->dropForeign(['authorized_agent_person_id']);
            $table->dropColumn('authorized_agent_person_id');
        });
    }
};
