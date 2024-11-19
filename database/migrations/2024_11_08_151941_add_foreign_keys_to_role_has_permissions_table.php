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
        Schema::table('role_has_permissions', function (Blueprint $table) {
            $table->foreign(['permission_id'], 'role_has_permissions_ibfk_1')->references(['id'])->on('permissions')->onUpdate('restrict')->onDelete('cascade');
            $table->foreign(['role_id'], 'role_has_permissions_ibfk_2')->references(['id'])->on('roles')->onUpdate('restrict')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('role_has_permissions', function (Blueprint $table) {
            $table->dropForeign('role_has_permissions_ibfk_1');
            $table->dropForeign('role_has_permissions_ibfk_2');
        });
    }
};
