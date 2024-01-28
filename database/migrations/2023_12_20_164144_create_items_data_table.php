<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('items_data', function (Blueprint $table) {
            $table->id();
            $table->string('name_item',50);
            $table->unsignedInteger('quantity')->nullable();
            $table->decimal('unity_cost',7,2,true);
            $table->decimal('total_cost',10,2,true);
            $table->string('model')->nullable();
            $table->string('version')->nullable();
            $table->string('dimension',50)->nullable();
            $table->double('weight',9,3)->nullable();
            $table->string('color',50)->nullable();
            $table->unsignedInteger('total_items')->nullable();
            $table->decimal('items_price',10,2,true)->nullable();
            $table->text('description')->nullable();

            $table->unsignedBigInteger('manufacturer_id')->nullable();
            $table->foreign('manufacturer_id')->references('id')->on('manufacturers')->onDelete('cascade')->onUpdate('cascade');


            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade')->onUpdate('cascade');


        });
    }


    public function down(): void
    {
        Schema::dropIfExists('item_data');
    }
};
