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
        Schema::table('subfile_claims', function (Blueprint $table) {
            $table->foreign(['subfile_id'], 'subfile_claims_ibfk_1')->references(['id'])->on('subfiles')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['attorney_id'], 'subfile_claims_ibfk_2')->references(['id'])->on('attorneys')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['claim_resolution_id'], 'subfile_claims_ibfk_3')->references(['id'])->on('claim_resolutions')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['claim_type_id'], 'subfile_claims_ibfk_4')->references(['id'])->on('claim_types')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['claim_status_id'], 'subfile_claims_ibfk_5')->references(['id'])->on('claim_statuses')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['resources_id'], 'subfile_claims_ibfk_6')->references(['id'])->on('resources')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('subfile_claims', function (Blueprint $table) {
            $table->dropForeign('subfile_claims_ibfk_1');
            $table->dropForeign('subfile_claims_ibfk_2');
            $table->dropForeign('subfile_claims_ibfk_3');
            $table->dropForeign('subfile_claims_ibfk_4');
            $table->dropForeign('subfile_claims_ibfk_5');
            $table->dropForeign('subfile_claims_ibfk_6');
        });
    }
};
