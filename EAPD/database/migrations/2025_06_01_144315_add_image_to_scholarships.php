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
        Schema::table('scholarships', function (Blueprint $table) {
            $table->string('image')->nullable();
            $table->string('program_en')->nullable();
            $table->string('program_fr')->nullable();
            $table->text('content_en')->nullable();
            $table->text('content_fr')->nullable();
            $table->text('content_ar')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('scholarships', function (Blueprint $table) {
            //
        });
    }
};
