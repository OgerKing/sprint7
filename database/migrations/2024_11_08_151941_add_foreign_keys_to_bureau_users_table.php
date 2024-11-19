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
        Schema::table('bureau_users', function (Blueprint $table) {
            $table->foreign(['bureau_id'], 'bureau_users_ibfk_1')->references(['id'])->on('bureaus')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['gis_duplicate_id'], 'bureau_users_ibfk_2')->references(['id'])->on('gis_duplicates')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['user_id'], 'fk_bu_user')->references(['id'])->on('users')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bureau_users', function (Blueprint $table) {
            $table->dropForeign('bureau_users_ibfk_1');
            $table->dropForeign('bureau_users_ibfk_2');
            $table->dropForeign('fk_bu_user');
        });
    }
};
