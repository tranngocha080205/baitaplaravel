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
            $table->string('name');                         // Tên sản phẩm
            $table->decimal('price', 10, 2);                // Giá
            $table->text('description')->nullable();        // Mô tả
            $table->string('image')->nullable();            // Hình ảnh
            $table->unsignedBigInteger('category_id');      // Liên kết đến bảng categories
            $table->boolean('top')->default(0);             // Sản phẩm nổi bật
            $table->timestamps();

            // Khóa ngoại
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
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
