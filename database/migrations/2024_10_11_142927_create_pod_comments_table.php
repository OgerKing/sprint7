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
        Schema::create('pod_comments', function (Blueprint $table) {
            $table->bigInteger('id')->primary();
            $table->bigInteger('pod_id');
            $table->date('pod_comment_date');
            $table->string('pod_comment_description', 250);
            $table->string('pod_comment_resource', 64);
            $table->bigInteger('pod_comment_type_id');
            $table->string('comment', 4000)->nullable();
            $table->dateTime('created_at', 6)->nullable();
            $table->string('created_by', 64);
            $table->dateTime('updated_at', 6)->nullable();
            $table->string('updated_by', 64);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pod_comments');
    }
};
