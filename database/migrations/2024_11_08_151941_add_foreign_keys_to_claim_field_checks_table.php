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
        Schema::table('claim_field_checks', function (Blueprint $table) {
            $table->foreign(['field_work_id'], 'claim_field_checks_ibfk_1')->references(['id'])->on('field_works')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['resource_id'], 'claim_field_checks_ibfk_2')->references(['id'])->on('resources')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('claim_field_checks', function (Blueprint $table) {
            $table->dropForeign('claim_field_checks_ibfk_1');
            $table->dropForeign('claim_field_checks_ibfk_2');
        });
    }
};
