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
        Schema::create('trial_terals', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->longText('contract_files');
            $table->text('contract_field');
            $table->integer('cost');
            $table->integer('agency_cost');
            $table->longText('details');
            $table->dateTime('start_date');
            $table->enum('status', ['active', 'disabled', 'holding']);
            $table->string('acceptation_number');
            $table->longText('notes')->nullable();
            $table->longText('beneficiary_countries');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trial_terals');
    }
};
