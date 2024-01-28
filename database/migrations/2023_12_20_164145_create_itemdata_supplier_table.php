<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('itemdata_supplier', function (Blueprint $table) {
            $table->unsignedBigInteger('item_data_id');
            $table->foreign('item_data_id')->references('id')->on('items_data')->onDelete('cascade');
            $table->unsignedBigInteger('supplier_id');
            $table->foreign('supplier_id')->references('id')->on('suppliers')->onDelete('cascade');
            $table->primary(['item_data_id', 'supplier_id']);
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('itemdata_supplier');
    }
};
