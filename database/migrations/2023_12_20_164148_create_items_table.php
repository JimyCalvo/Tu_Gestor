<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->string('status');
            $table->text('comment');
            $table->date('check_date')->nullable();
            $table->string('unique_code')->nullable();

            $table->unsignedBigInteger('supplier_id');
            $table->foreign('supplier_id')->references('id')->on('suppliers')->onDelete('cascade');

            $table->unsignedBigInteger('inventory_id');
            $table->foreign('inventory_id')->references('id')->on('inventories')->onDelete('cascade')->onUpdate('cascade');

            $table->unsignedBigInteger('custody_id')->nullable();
            $table->foreign('custody_id')->references('id')->on('users')->onDelete('set null')->onUpdate('cascade');

            $table->unsignedBigInteger('item_data_id');
            $table->foreign('item_data_id')->references('id')->on('items_data')->onDelete('cascade')->onUpdate('cascade');

            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
