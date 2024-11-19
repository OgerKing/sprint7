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
        Schema::create('water_right_comments', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->bigInteger('water_right_id')->index();
            $table->bigInteger('water_right_comment_category_id')->index();
            $table->string('water_right_comment', 1000);
            $table->string('ose_resource', 64);
            $table->timestamp('created_at')->nullable();
            $table->string('created_by', 64);
            $table->timestamp('updated_at')->nullable();
            $table->string('updated_by', 64);
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('water_right_comments');
    }
};
