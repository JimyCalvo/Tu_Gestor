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
        Schema::create('item_histories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('item_id')->nullable();
            $table->string('operation');
            $table->foreign('item_id')->references('id')->on('items')->onDelete('cascade');

            $table->unsignedBigInteger('responsible_id')->nullable();
            $table->foreign('responsible_id')->references('id')->on('users')->onDelete('set null');
            $table->string('responsible_name')->nullable();
            $table->string('responsible_dni')->nullable();

            $table->unsignedBigInteger('custody_id')->nullable();
            $table->foreign('custody_id')->references('id')->on('users')->onDelete('set null');
            $table->string('custody_name')->nullable();
            $table->string('custody_dni')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('item_histories');
    }
};
