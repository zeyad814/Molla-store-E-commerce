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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->float('total');
            $table->float('discount')->default(0);
            $table->string('coupon_code')->nullable();
            ///
            $table->string('first_name');
            $table->string('last_name');
            $table->text('address');
            $table->string('email');
            $table->string('state');
            $table->string('town');
            $table->string('postal_code');
            $table->string('phone');
            $table->text('notes')->nullable();
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
