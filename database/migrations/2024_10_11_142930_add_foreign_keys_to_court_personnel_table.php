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
        Schema::table('court_personnel', function (Blueprint $table) {
            $table->foreign(['court_id'], 'court_personnel_ibfk_1')->references(['id'])->on('courts')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['court_role_id'], 'court_personnel_ibfk_2')->references(['id'])->on('court_roles')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('court_personnel', function (Blueprint $table) {
            $table->dropForeign('court_personnel_ibfk_1');
            $table->dropForeign('court_personnel_ibfk_2');
        });
    }
};
