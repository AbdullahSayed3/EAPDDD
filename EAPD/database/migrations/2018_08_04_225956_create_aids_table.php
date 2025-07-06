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
        Schema::create('aids', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('type_id');
            $table->integer('country_id');
            $table->string('country_org');
            $table->string('minister_name');
            $table->timestamp('ship_date');
            $table->timestamp('arrive_date');
            $table->longText('suppliers');
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
        Schema::dropIfExists('aids');
    }
};
