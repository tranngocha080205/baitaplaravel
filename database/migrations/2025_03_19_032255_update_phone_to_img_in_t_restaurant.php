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
        Schema::table('t_restaurant', function (Blueprint $table) {
            $table->dropColumn('phone'); // Xóa cột phone
            $table->string('img')->nullable()->after('address'); // Thêm cột img
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('t_restaurant', function (Blueprint $table) {
            $table->dropColumn('img'); // Xóa cột img nếu rollback
            $table->string('phone')->nullable(); // Khôi phục cột phone nếu rollback
        });
    }
};
