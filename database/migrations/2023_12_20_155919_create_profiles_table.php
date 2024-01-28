<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->string('dni',13)->nullable();
            $table->string('passport',15)->nullable();
            $table->unique(['dni', 'passport']);
            $table->string('phone_user', 20)->nullable();
            $table->string('tel_user', 11);
            $table->text('address');
            $table->date('birthday');
            $table->string('gender',15);
            $table->string('job_title');
            $table->string('tel_job', 20)->nullable();


            $table->unsignedBigInteger('user_id')->unique();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};
