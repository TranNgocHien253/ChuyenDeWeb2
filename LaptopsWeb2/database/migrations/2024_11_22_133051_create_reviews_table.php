<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReviewsTable extends Migration
{
    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id(); // Tạo trường id cho review
            $table->unsignedBigInteger('product_id'); // Khóa ngoại đến bảng products
            $table->string('name'); // Tên người đánh giá
            $table->text('description'); // Mô tả đánh giá
            $table->integer('rating'); // Đánh giá (sao, điểm...)
            $table->timestamps(); // Timestamps cho created_at và updated_at

            // Khóa ngoại liên kết với bảng products
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('reviews');
    }
}
