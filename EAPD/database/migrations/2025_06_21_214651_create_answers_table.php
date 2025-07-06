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
        Schema::create('answers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('evaluation_id')->nullable()->constrained('evaluations')->cascadeOnDelete();
            $table->unsignedInteger('applicant_id')->nullable();
            $table->foreign('applicant_id')->references('id')->on('applications')->onDelete('cascade');
            $table->unsignedInteger('course_id')->nullable();

            $table->text('answer')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('answers');
    }
};
