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
        Schema::create('pyschomotors', function (Blueprint $table) {
            $table->id();
            $table->foreignId("student_id")->constrained()->onDelete('cascade');
            $table->foreignId("schoolsession_id")->constrained()->onDelete('cascade');
            $table->foreignId("semester_id")->constrained()->onDelete('cascade');
            $table->string('type');
            $table->string('marks');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pyschomotors');
    }
};
