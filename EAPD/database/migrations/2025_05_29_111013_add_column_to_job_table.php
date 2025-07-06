<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('jobs', function (Blueprint $table) {
            //
            $table->boolean('is_active')->default(true);
            $table->string('code')->nullable()->after('is_active');
        });
        DB::statement('ALTER TABLE jobs CHANGE Benefit benefit TEXT');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('jobs', function (Blueprint $table) {
            //
        });
    }
};
