<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    use HasFactory;

    protected $table = 't_restaurant'; // Đặt đúng tên bảng trong database

    protected $fillable = ['name', 'address', 'phone', 'description']; // Các cột có thể thêm/sửa

    public $timestamps = true; // Nếu bảng có cột created_at và updated_at
}
