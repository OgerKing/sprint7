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
        Schema::table('wrats_user_subfile_notifications', function (Blueprint $table) {
            $table->foreign(['file_location_id'], 'wrats_user_subfile_notifications_ibfk_1')->references(['id'])->on('file_locations')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['subfile_id'], 'wrats_user_subfile_notifications_ibfk_2')->references(['id'])->on('subfiles')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['wrats_user_id'], 'wrats_user_subfile_notifications_ibfk_3')->references(['id'])->on('wrats_users')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('wrats_user_subfile_notifications', function (Blueprint $table) {
            $table->dropForeign('wrats_user_subfile_notifications_ibfk_1');
            $table->dropForeign('wrats_user_subfile_notifications_ibfk_2');
            $table->dropForeign('wrats_user_subfile_notifications_ibfk_3');
        });
    }
};
