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
        Schema::table('custom_jobs', function (Blueprint $table) {
            $table->unsignedBigInteger('available_at')->change();
            $table->unsignedBigInteger('created_at')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('custom_jobs', function (Blueprint $table) {
            $table->timestamp('available_at')->change();
            $table->timestamp('created_at')->change();
        });
    }
};
