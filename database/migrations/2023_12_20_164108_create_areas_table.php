<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('areas', function (Blueprint $table) {
            $table->id();
            $table->string('name_area',50);
            $table->string('address_area');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('areas');
    }
};
