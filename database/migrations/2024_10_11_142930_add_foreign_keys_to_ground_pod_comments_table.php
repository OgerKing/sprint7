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
        Schema::table('ground_pod_comments', function (Blueprint $table) {
            $table->foreign(['ground_pod_id'], 'ground_pod_comments_ibfk_1')->references(['id'])->on('ground_pods')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ground_pod_comments', function (Blueprint $table) {
            $table->dropForeign('ground_pod_comments_ibfk_1');
        });
    }
};
