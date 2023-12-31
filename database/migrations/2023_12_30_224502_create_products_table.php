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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('product_name')->nullable();
            $table->string('product_description')->nullable();
            $table->string('product_image')->nullable();
            $table->dateTime('buy_date')->nullable();
            $table->dateTime('expire_date')->nullable();
            $table->float('buying_price')->nullable()->default(0.00);
            $table->float('selling_price')->nullable()->default(0.00);
            $table->integer('stock')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
