<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // Nếu bảng không phải là 'products', cần khai báo tên bảng
    // protected $table = 'ten_bang';

    // Các cột có thể gán dữ liệu hàng loạt
    protected $fillable = [
        'name',
        'description',
        'image',
        'unit_price',
        'promotion_price',
        'unit',
        'new',
    ];

    // Quan hệ: Một sản phẩm có thể xuất hiện trong nhiều chi tiết hóa đơn
    public function billDetails()
    {
        return $this->hasMany(BillDetail::class, 'id_product');
    }
}
