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
            $table->foreignId('category_id')->constrained('type_products'); // Khóa ngoại đến bảng type_products cho danh mục
            $table->foreignId('product_id')->constrained('products'); // Khóa ngoại đến bảng products cho sản phẩm
            $table->string('name'); // Người nhận
            $table->string('phone'); // Số điện thoại
            $table->integer('quantity'); // Số lượng
            $table->string('address'); // Địa chỉ
            $table->decimal('total', 10, 2); // Tổng tiền (sẽ tính toán dựa trên sản phẩm và số lượng)
            $table->decimal('price', 10, 2); // Giá sản phẩm
            $table->string('status')->default('approved')->check('status IN ("approved", "rejected")');// Trạng thái, mặc định là 'pending: chờ duyệt'
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
