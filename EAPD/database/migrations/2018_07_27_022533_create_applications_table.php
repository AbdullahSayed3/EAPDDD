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
        Schema::create('applications', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('course_id');
            $table->string('first_name');
            $table->string('middle_name');
            $table->string('last_name');
            $table->enum('gender', ['male', 'female']);
            $table->string('nationality');
            $table->string('address');
            $table->string('phone_number');
            $table->string('email_address');
            $table->dateTime('birth_date');
            $table->string('personal_picture');
            $table->string('passport_id');
            $table->longText('passport_photos');
            $table->string('qualification');
            $table->longText('qualification_certificates');
            $table->text('languages');
            $table->string('country');
            $table->string('current_employer');
            $table->string('employer_address');
            $table->string('employer_phone');
            $table->string('employer_email');
            $table->text('cv_file');
            $table->text('health_certificates');
            $table->text('other_certificates');
            $table->enum('trainee_status', ['primary', 'secondary']);
            $table->enum('wait_list', ['false', 'true']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applications');
    }
};
