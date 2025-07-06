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
        Schema::table('courses', function (Blueprint $table) {
            //
            $table->string('name_fr')->nullable()->after('name_en');
            $table->text('content_en')->nullable()->after('content');
            $table->text('content_fr')->nullable()->after('content_en');
            $table->boolean('is_active')->default(true)->after('notes');
            $table->string('image')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('courses', function (Blueprint $table) {
            //
        });
    }
};
