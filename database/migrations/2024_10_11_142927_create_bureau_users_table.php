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
        Schema::create('bureau_users', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->bigInteger('bureau_id')->index('bureau_id_index');
            $table->bigInteger('user_id')->index('user_id');
            $table->bigInteger('gis_duplicate_id')->index();
            $table->string('login_name', 64);
            $table->timestamp('created_at')->nullable();
            $table->string('created_by', 64);
            $table->timestamp('updated_at')->nullable();
            $table->string('updated_by', 64);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bureau_users');
    }
};
