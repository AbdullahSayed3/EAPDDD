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
        Schema::table('course_partners', function (Blueprint $table) {
            $table->string('name_fr')->nullable()->after('name');
            $table->string('name_en')->nullable()->after('name_fr');
            $table->string('address_fr')->nullable()->after('address');
            $table->string('address_en')->nullable()->after('name_fr');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('course_partners', function (Blueprint $table) {
            //
        });
    }
};
