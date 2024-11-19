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
        Schema::table('person_type_subtypes', function (Blueprint $table) {
            $table->foreign(['person_type_id'], 'person_type_id_ibfk_1')->references(['id'])->on('person_types')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('person_type_subtypes', function (Blueprint $table) {
            $table->dropForeign('person_type_id_ibfk_1');
        });
    }
};
