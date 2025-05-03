<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\User;
use App\Models\Job;

return new class extends Migration
{
    public function up()
    {
        Schema::table('job_applications', function (Blueprint $table) {
            // First drop the existing foreign key constraint
            $table->dropForeign(['job_id']); // Use the column name in array

            // Recreate with cascade delete
            $table->foreign('job_id')
                  ->references('id')
                  ->on('jobs')
                  ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('job_applications', function (Blueprint $table) {
            $table->dropForeign(['job_id']);

            // Recreate original constraint (restrict)
            $table->foreign('job_id')
                  ->references('id')
                  ->on('jobs');
        });
    }
};
