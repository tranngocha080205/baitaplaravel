<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Mf extends Model
{
    use HasFactory;

    protected $table = 'mfs'; // Tên bảng trong database

    protected $fillable = ['mf_name']; // Các cột được phép điền dữ liệu

    /**
     * Mối quan hệ: Một nhà sản xuất (Mf) có nhiều xe (Car)
     */
    public function cars(): HasMany
    {
        return $this->hasMany(Car::class, 'mf_id', 'id'); // Một Mf có nhiều Car
    }
}
