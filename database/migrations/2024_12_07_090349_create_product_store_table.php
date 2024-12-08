<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('product_store', function (Blueprint $table) {
            $table->id();
            $table->integer('product_id')->onDelete('cascade');
            $table->integer('store_id')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('product_store');
    }


    /**
     * Reverse the migrations.
     */
};
