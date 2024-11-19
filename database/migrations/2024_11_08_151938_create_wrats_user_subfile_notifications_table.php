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
        Schema::create('wrats_user_subfile_notifications', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->bigInteger('wrats_user_id')->index('fk_wrats_808920');
            $table->bigInteger('subfile_id')->index('fk_subfil643284');
            $table->bigInteger('file_location_id')->index('fk_file_l540685');
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
        Schema::dropIfExists('wrats_user_subfile_notifications');
    }
};
