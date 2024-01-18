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
        Schema::disableForeignKeyConstraints();

        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('program_id');
            $table->foreignId('applicant_id');
            $table->unique(['program_id', 'applicant_id']);
            $table->json('values');
            $table->foreignId('status_id')->default('1');
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applications');
    }
};
