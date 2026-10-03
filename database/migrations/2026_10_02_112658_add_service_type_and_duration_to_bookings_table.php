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
        Schema::table('bookings', function (Blueprint $table) {
            $table->string('service_type')->default('daycare')->after('pet_id');
            $table->unsignedInteger('duration')->default(1)->after('service_type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropColumn(['service_type', 'duration']);
        });
    }
};

// $table->string('service_type')->default('daycare')->after('pet_id') — adds a text column for the 
// service type (daycare/overnight/grooming), positioned right after pet_id for readability in the 
// database, defaulting to 'daycare' so existing bookings don't break
// $table->unsignedInteger('duration')->default(1) — a whole number for how many days, defaulting to 
// 1 (unsigned just means "can't be negative," which makes sense for a day count)
// down() — this is the "undo" for this migration; if you ever needed to reverse it, Laravel knows to 
// remove these two columns
