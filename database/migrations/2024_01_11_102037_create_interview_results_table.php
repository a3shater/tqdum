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

        Schema::create('interview_results', function (Blueprint $table) {
            $table->id();
            $table->string('note')->nullable();
            $table->foreignId('interviewer_id');
            $table->foreignId('interview_id');
            $table->unique(['interviewer_id', 'interview_id']);
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('interview_results');
    }
};
