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
        Schema::create('user_settings', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->string('created_by', 64);
            $table->string('display_name', 200);
            $table->string('initials', 12);
            $table->string('updated_by', 64);
            $table->string('watch_subfile_changes_frequency', 24);
            $table->timestamps();
            $table->bigInteger('user_id')->nullable()->index('user_id_sdfsd');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_settings');
    }
};
