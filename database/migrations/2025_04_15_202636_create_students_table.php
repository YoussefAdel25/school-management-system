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
            $table->text('name');
            $table->string('email');
            $table->string('password');
            $table->bigInteger('nationalId');
            $table->date('dateBirth');
            $table->string('academicYear');
            $table->unsignedBigInteger('parentId');
            $table->foreign('parentId')->references('id')->on('my_parents')->onDelete('cascade');
            $table->unsignedBigInteger('genderId');
            $table->foreign('genderId')->references('id')->on('genders')->onDelete('cascade');
            $table->unsignedBigInteger('nationalityId');
            $table->foreign('nationalityId')->references('id')->on('nationalities')->onDelete('cascade');
            $table->unsignedBigInteger('bloodId');
            $table->foreign('bloodId')->references('id')->on('bloods')->onDelete('cascade');
            $table->unsignedBigInteger('religionId');
            $table->foreign('religionId')->references('id')->on('religions')->onDelete('cascade');
            $table->unsignedBigInteger('gradeId');
            $table->foreign('gradeId')->references('id')->on('grades')->onDelete('cascade');
            $table->unsignedBigInteger('classId');
            $table->foreign('classId')->references('id')->on('classrooms')->onDelete('cascade');
            $table->unsignedBigInteger('sectionId');
            $table->foreign('sectionId')->references('id')->on('sections')->onDelete('cascade');
            $table->timestamps();

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
