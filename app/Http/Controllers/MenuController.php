<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index()
    {
        $menu = [
            'Cơm Dĩa' => [
                ['name' => 'CƠM SIÊU MAI', 'price' => '69,000 đ', 'desc' => 'Cơm với thịt siêu mai đặc biệt', 'image' => 'com_sieu_mai.jpeg'],
                ['name' => 'CƠM CHAY', 'price' => '69,000 đ', 'desc' => 'Cơm chay với rau củ tươi ngon', 'image' => 'com_chay.jpeg'],
                ['name' => 'CƠM xá xíu', 'price' => '69,000 đ', 'desc' => 'Cơm chay với rau củ tươi ngon', 'image' => 'com_xa_xieu.jpg'],
            ],
            'Bánh Mì' => [
                ['name' => 'BÁNH MÌ HEO QUAY', 'price' => '69,000 đ', 'desc' => 'Bánh mì với thịt heo quay giòn rụm', 'image' => 'banh_mi_heo_quay.jpg'],
                ['name' => 'BÁNH MÌ CHẢ LỤA', 'price' => '69,000 đ', 'desc' => 'Bánh mì với chả lụa thơm ngon', 'image' => 'banh_mi_cha_lua.jpg'],
                ['name' => 'BÁNH MÌ NEM NƯỚNG', 'price' => '69,000 đ', 'desc' => 'Bánh mì với nem nướng đặc biệt', 'image' => 'banh_mi_nem_nuong.jpg'],
                
            ],
            'Bún Phở (Món Nước)' => [
                ['name' => 'PHỞ BÒ', 'price' => '79,000 đ', 'desc' => 'Phở bò truyền thống với nước dùng đậm đà', 'image' => 'pho_bo.jpg'],
                ['name' => 'BÚN BÒ HUẾ', 'price' => '75,000 đ', 'desc' => 'Bún bò Huế cay nồng, thơm ngon', 'image' => 'bun_bo_hue.jpg'],
                ['name' => 'BÚN CHẢ CÁ', 'price' => '70,000 đ', 'desc' => 'Bún chả cá Nha Trang, đậm vị biển', 'image' => 'bun_cha_ca.jpg'],
            ]
        ];

        return view('restaurants.menu', compact('menu'));
    }
}
