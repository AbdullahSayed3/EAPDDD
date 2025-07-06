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
        Schema::create('experts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->string('country')->nullable();
            $table->string('specialist')->nullable();
            $table->string('sub_specialist')->nullable();
            $table->string('qualification')->nullable();
            $table->longText('certifications')->nullable();
            $table->enum('gender', ['male', 'female'])->nullable();
            $table->string('personal_picture')->nullable()->nullable();
            $table->string('passport_number')->nullable();
            $table->longText('passport_photos')->nullable();
            $table->longText('languages')->nullable();
            $table->string('current_employer')->nullable();
            $table->string('employer_address')->nullable();
            $table->string('employer_phone')->nullable();
            $table->string('employer_email')->nullable();
            $table->longText('old_contracts')->nullable();
            $table->string('cv')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->enum('status', ['current', 'old', 'candidate'])->nullable();
            $table->longText('contract_rules')->nullable();
            $table->string('delegate_country')->nullable();
            $table->string('delegate_org')->nullable();
            $table->dateTime('contract_date')->nullable();
            $table->dateTime('end_date')->nullable();
            $table->longText('acceptation_info')->nullable();
            $table->integer('cost')->nullable();
            $table->longText('notes')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**trialateral
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('experts');
    }
};
