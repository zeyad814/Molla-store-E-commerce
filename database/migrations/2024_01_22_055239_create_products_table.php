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
            $table->foreignId('category_id')->constrained('categories')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('brand_id')->constrained('brands')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('product_name');
            $table->string('product_code')->unique();
            $table->string('product_color')->nullable();
            // $table->string('family_color')->nullable();
            // $table->string('group_code')->nullable();
            $table->float('product_price');
            $table->float('product_discount')->default(0);
            $table->string('discount_type')->nullable();
            $table->float('final_price');
            // $table->string('product_video')->nullable();
            $table->string('main_image');
            $table->string('image_1')->nullable();
            $table->string('image_2')->nullable();
            // $table->string('image_3')->nullable();
            $table->text ('description');
            // $table->text ('keywords')->nullable();
            $table->string('sku')->nullable();
            $table->string('stock');
            // $table->string('meta_title')->nullable();
            $table->string('meta_description')->nullable();
            // $table->string('meta_keywords')->nullable();
            $table->enum('is_featured',['yes','no']);
            $table->enum('is_bestseller',['yes','no'])->default('no');
            $table->tinyInteger('status')->defualt(1);
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
