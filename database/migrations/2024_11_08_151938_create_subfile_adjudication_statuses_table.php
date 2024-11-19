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
        Schema::create('subfile_adjudication_statuses', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->char('subfile_adjudication_status_code', 2);
            $table->string('subfile_adjudication_status_description', 128);
            $table->bigInteger('sort');
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
        Schema::dropIfExists('subfile_adjudication_statuses');
    }
};
