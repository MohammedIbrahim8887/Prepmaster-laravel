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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('dept_id');
            $table->unsignedBigInteger('org_id');
            $table->string('fullName');
            $table->string('email');
            $table->string('phoneNumber');
            $table->string('gender');
            $table->string('password');
            $table->timestamp('created_at')->default(now());
            $table->timestamp('updated_at')->default(now());

            // Define the foreign key relationship
            $table->foreign('dept_id')->references('id')->on('departments')->onDelete('cascade');
            $table->foreign('org_id')->references('id')->on('organizations')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
