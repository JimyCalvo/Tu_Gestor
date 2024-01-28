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
        Schema::create('inventories', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('quantity')->default(0);
            $table->decimal('inventory_cost',10,2,true)->nullable();

            $table->unsignedBigInteger('repository_id')->nullable();
            $table->foreign('repository_id')->references('id')->on('repositories')->onDelete('cascade')->onUpdate('cascade');

            $table->unsignedBigInteger('responsible_id')->nullable();
            $table->foreign('responsible_id')->references('id')->on('users')->onDelete('set null')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventories');
    }
};
