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
        Schema::create('teams', function (Blueprint $table) {
            $table->id();
            $table->string('name_ar')->nullable();
            $table->string('name_en')->nullable();
            $table->string('name_fr')->nullable();
            $table->string('job_en')->nullable();
            $table->string('job_ar')->nullable();
            $table->string('job_fr')->nullable();
            $table->string('image')->nullable();
            $table->boolean('is_active')->default(false);
            $table->boolean('is_main')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teams');
    }
};
