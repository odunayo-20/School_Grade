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
        Schema::create('circulars', function (Blueprint $table) {
            $table->id();
            // $table->foreignId('schoolsession_id')->constrained()->onDelete('cascade');
            // $table->foreignId('class_id')->constrained()->onDelete('cascade');
            $table->foreignId('schoolsession_id')->constrained('school_sessions')->references('id')->on('school_sessions')->onDelete('cascade');
            $table->foreignId('semester_id')->constrained('semesters')->references('id')->on('semesters')->onDelete('cascade');
            $table->string('title');
            $table->text('message');
            $table->date('circular_date');
            $table->string('attachment_path')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('circulars');
    }
};
