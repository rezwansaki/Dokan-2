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
        Schema::create('purchasesdetails', function (Blueprint $table) {
            $table->id();
            $table->integer('purchase_id');
            $table->integer('product_id');
            $table->integer('quantity');
            $table->float('buying_price')->nullable()->default(0.00);
            $table->float('total_purchase_price')->nullable()->default(0.00);
            $table->float('selling_price')->nullable()->default(0.00);
            $table->float('total_selling_price')->nullable()->default(0.00);
            $table->string('note')->nullable();
            $table->dateTime('buy_date')->nullable();
            $table->dateTime('expire_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchasesdetails');
    }
};
