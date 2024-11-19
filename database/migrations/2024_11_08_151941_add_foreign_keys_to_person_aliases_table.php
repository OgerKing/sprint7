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
        Schema::table('person_aliases', function (Blueprint $table) {
            $table->foreign(['person_id'], 'person_aliases_ibfk_1')->references(['id'])->on('persons')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['person_alias_type_id'], 'person_aliases_ibfk_2')->references(['id'])->on('person_alias_types')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('person_aliases', function (Blueprint $table) {
            $table->dropForeign('person_aliases_ibfk_1');
            $table->dropForeign('person_aliases_ibfk_2');
        });
    }
};
