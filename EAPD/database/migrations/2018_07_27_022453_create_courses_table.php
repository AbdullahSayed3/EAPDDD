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
        Schema::create('courses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name_ar');
            $table->string('name_en');
            $table->enum('type_id',['citizan','police','army']);
            $table->integer('field_id');
            $table->longText('content');
            $table->timestamp('start_date');
            $table->timestamp('end_date');
            $table->text('location');
            $table->integer('organization_id');
            $table->longText('documents');
            $table->longText('countries');
            $table->longText('trainees');
            $table->integer('cost');
            $table->string('notes')->nullable();
            $table->softDeletes();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
