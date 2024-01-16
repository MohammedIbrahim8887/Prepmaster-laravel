<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('student_subscriptions', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->unsignedBigInteger('student_id');
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->string('status')->default('Active');
            $table->timestamps();

            // Define the foreign key relationship
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_subscriptions');
    }
};
