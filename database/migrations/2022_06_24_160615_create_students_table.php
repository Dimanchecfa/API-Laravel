<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->String('matricule');
            $table->String('nom');
            $table->String('prenom');
            $table->String('email');
            $table->String('cycle')->nullable()->default('License');
            $table->String('niveau')->nullable()->default('License 1');
            $table->String('annee_academique')->nullable()->default('2022-2023');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('students');
    }
};
