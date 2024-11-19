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
        Schema::create('adjudication_subsections', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->bigInteger('parent_adjudication_subsection_id')->index('as_parent_as_id_index');
            $table->bigInteger('child_adjudication_subsection_id')->index('as_child_as_id_index');
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
        Schema::dropIfExists('adjudication_subsections');
    }
};
