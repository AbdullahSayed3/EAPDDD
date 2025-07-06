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
        Schema::create('scholarships', function (Blueprint $table) {
            $table->increments('id');
            $table->string('program');
            $table->string('owner');
            $table->string('department');
            $table->integer('learners_num');
            $table->longText('participants');
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->longText('annual_cost');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('scholarships');
    }
};
