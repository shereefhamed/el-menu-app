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
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id');
            $table->integer('quantity');
            $table->unsignedBigInteger('menu_item_id')->nullable();
            $table->string('item_name');
            // $table->decimal('base_price');
            $table->decimal('unit_price');
            $table->decimal('total');
            $table->json('addons')->nullable();
            $table->json('attribute')->nullable();
            $table->string('notes')->nullable();

            $table->foreign('order_id')
            ->references('id')
            ->on('orders')
            ->onDelete('cascade');
            $table->foreign('menu_item_id')
            ->references('id')
            ->on('menu_items')
            ->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
