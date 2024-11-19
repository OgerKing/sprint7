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
        Schema::create('subfile_user_watch', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->bigInteger('subfile_id')->nullable()->index('fk_suw_subfile');
            $table->bigInteger('wrats_user_id')->nullable()->index('fk_suw_user');
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
        Schema::dropIfExists('subfile_user_watch');
    }
};
