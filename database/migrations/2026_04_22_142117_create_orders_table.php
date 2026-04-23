<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('restaurant_id');
            $table->enum('order_type', ['dine_in', 'delivery', 'pickup']);
            $table->enum('status', ['pending', 'preparing', 'completed', 'cancelled'])
                ->default('pending');
            $table->decimal('delivery_fee')->default(0);
            $table->decimal('service_fee')->default(0);
            $table->decimal('subtotal');
            $table->decimal('total');
            $table->string('customer_name')->nullable();
            $table->string('address')->nullable();
            $table->string('phone')->nullable();
            $table->integer('table_number')->nullable();

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('set null');
            $table->foreign('restaurant_id')
                ->references('id')
                ->on('restaurants')
                ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
