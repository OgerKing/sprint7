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
        Schema::table('attorney_listings', function (Blueprint $table) {
            $table->foreign(['attorney_id'], 'attorney_listings_ibfk_1')->references(['id'])->on('attorneys')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('attorney_listings', function (Blueprint $table) {
            $table->dropForeign('attorney_listings_ibfk_1');
        });
    }
};
