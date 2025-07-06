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
        Schema::table('courses', function (Blueprint $table) {
            $table->string('benefit_ar')->nullable();
            $table->string('requirement_ar')->nullable();
            $table->string('benefit_en')->nullable();
            $table->string('requirement_en')->nullable();
            $table->string('benefit_fr')->nullable();
            $table->string('requirement_fr')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('courses', function (Blueprint $table) {
            //
        });
    }
};
