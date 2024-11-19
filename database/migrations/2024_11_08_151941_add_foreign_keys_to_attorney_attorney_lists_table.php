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
        Schema::table('attorney_attorney_lists', function (Blueprint $table) {
            $table->foreign(['attorney_id'], 'attorney_attorney_lists_ibfk_1')->references(['id'])->on('attorneys')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['attorney_list_id'], 'attorney_attorney_lists_ibfk_2')->references(['id'])->on('attorney_lists')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('attorney_attorney_lists', function (Blueprint $table) {
            $table->dropForeign('attorney_attorney_lists_ibfk_1');
            $table->dropForeign('attorney_attorney_lists_ibfk_2');
        });
    }
};
