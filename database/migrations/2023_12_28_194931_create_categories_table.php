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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            // $table->integer('parent_id');
            $table->string('category_name');
            $table->string('category_image')->nullable();
            $table->string('url')->nullable();
            $table->float('category_discount')->default(0);
            $table->text('description')->nullable();
            // $table->string('meta_title');
            // $table->string('meta_description');
            // $table->string('meta_keywords');
            $table->tinyInteger('status')->default(1);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
