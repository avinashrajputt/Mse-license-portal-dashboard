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
        // Check if the 'status' column does not already exist
        if (!Schema::hasColumn('licenses', 'status')) {
            Schema::table('licenses', function (Blueprint $table) {
                $table->string('status')->default('Active'); // Default status is Active
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Check if the 'status' column exists before dropping it
        if (Schema::hasColumn('licenses', 'status')) {
            Schema::table('licenses', function (Blueprint $table) {
                $table->dropColumn('status');
            });
        }
    }
};