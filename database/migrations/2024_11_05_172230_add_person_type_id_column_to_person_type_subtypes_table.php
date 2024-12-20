<?php

use App\Models\PersonType;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('person_type_subtypes', function (Blueprint $table) {
            $table->foreignIdFor(PersonType::class);
        });
    }

    public function down(): void
    {
        Schema::table('person_type_subtypes', function (Blueprint $table) {
            $table->dropForeignIdFor(PersonType::class);
        });
    }
};
