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
        Schema::create('ebid_parcels', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->bigInteger('ebid_id')->index();
            $table->bigInteger('r_id');
            $table->bigInteger('parcel_num');
            $table->double('parcel_acres');
            $table->bigInteger('subfile_id')->index();
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
        Schema::dropIfExists('ebid_parcels');
    }
};
