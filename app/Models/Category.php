<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'type_products'; // bảng trong CSDL
    protected $fillable = ['name', 'description', 'image']; // các cột cho phép ghi dữ liệu
}
