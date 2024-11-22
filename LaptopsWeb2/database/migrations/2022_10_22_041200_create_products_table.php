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
            $table->foreignId('id_type')->constrained('type_products');
            // $table->unsignedBigInteger('id_type')->default(1); // Hoặc giá trị mặc định bạn muốn
            $table->string('name');
            $table->text('description');
            $table->decimal('unit_price', 10, 2);
            $table->decimal('promotion_price', 10, 2)->default(0);
            $table->longText('image');
            $table->integer('new')->default(0);
            $table->integer('quantity')->default(0);
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