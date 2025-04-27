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
        Schema::create('resumptions', function (Blueprint $table) {
            $table->id();
            $table->foreignId("schoolsession_id")->constrained()->onDelete('cascade');
            $table->foreignId("semester_id")->constrained()->onDelete('cascade');
            $table->text('resumption_date');
            $table->text('vacation_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resumptions');
    }
};
