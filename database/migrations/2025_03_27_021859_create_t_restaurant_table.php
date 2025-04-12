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
        Schema::create('t_restaurant', function (Blueprint $table) {
            $table->id();
            $table->string('name');      // Tên nhà hàng
            $table->string('address');   // Địa chỉ nhà hàng
            $table->string('phone')->nullable(); // Số điện thoại (có thể null)
            $table->string('img')->nullable();   // Hình ảnh nhà hàng (có thể null)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_restaurant');
    }
};
