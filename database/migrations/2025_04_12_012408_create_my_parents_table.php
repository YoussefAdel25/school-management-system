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
        Schema::create('my_parents', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique();
            $table->string('password');

            // Father Information
            $table->string('fatherName');
            $table->string('nationalIdFather');
            $table->string('passportIdFather');
            $table->string('phoneFather');
            $table->string('jobFather');
            $table->unsignedBigInteger('nationalityFatherId');
            $table->unsignedBigInteger('bloodFatherId');
            $table->unsignedBigInteger('religionFatherId');
            $table->string('addressFather');


            //Mother Information
            $table->string('nameMother');
            $table->string('nationalIdMother');
            $table->string('passportIdMother');
            $table->string('phoneMother');
            $table->string('jobMother');
            $table->unsignedBigInteger('nationalityMotherId');
            $table->unsignedBigInteger('bloodMotherId');
            $table->unsignedBigInteger('religionMotherId');
            $table->string('addressMother');


            $table->foreign('nationalityFatherId')
            ->references('id')
            ->on('nationalities')->onDelete('cascade');

            $table->foreign('bloodFatherId')->references('id')->on('bloods')->onDelete('cascade');
            $table->foreign('religionFatherId')->references('id')->on('religions')->onDelete('cascade');

            $table->foreign('nationalityMotherId')->references('id')->on('nationalities')->onDelete('cascade');
            $table->foreign('bloodMotherId')->references('id')->on('bloods')->onDelete('cascade');
            $table->foreign('religionMotherId')->references('id')->on('religions')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('my_parents');
    }
};
