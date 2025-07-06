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
        Schema::table('aids', function (Blueprint $table) {
            $table->string('title_en')->nullable()->after('id');
            $table->string('title_ar')->nullable()->after('title_en');
            $table->string('title_fr')->nullable()->after('title_ar');
            $table->text('description_en')->nullable();
            $table->text('description_ar')->nullable();
            $table->text('description_fr')->nullable();
            $table->string('image')->nullable();
            $table->string('file')->nullable();
            $table->string('url')->nullable();
            $table->string('contact')->nullable();
            $table->boolean('is_active')->default(true)->after('contact');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('aids', function (Blueprint $table) {
            //
        });
    }
};
