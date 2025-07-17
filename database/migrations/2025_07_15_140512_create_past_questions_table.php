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
        Schema::create('past_questions', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // Question text
            $table->text('options')->nullable(); // JSON encoded options if multiple choice
            $table->string('correct_option')->nullable();
            $table->text('answer')->nullable(); // For theory
            $table->string('subject');
            $table->string('class');
            $table->string('term');
            $table->string('session'); // e.g., 2022/2023
            $table->enum('type', ['theory', 'objective']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('past_questions');
    }
};
