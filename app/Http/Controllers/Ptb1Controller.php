<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Ptb1Controller extends Controller
{
    // Hiển thị trang nhập dữ liệu
    public function index()
    {
        return view('ptb1', ['kq' => null]);
    }

    // Xử lý giải phương trình bậc 1
    public function solve(Request $request)
    {
        // Validation dữ liệu nhập vào
        $request->validate([
            'hsa' => 'required|numeric',
            'hsb' => 'required|numeric',
        ], [
            'hsa.required' => 'Hệ số a không được để trống.',
            'hsa.numeric' => 'Hệ số a phải là số.',
            'hsb.required' => 'Hệ số b không được để trống.',
            'hsb.numeric' => 'Hệ số b phải là số.',
        ]);

        $a = (float) $request->input('hsa');
        $b = (float) $request->input('hsb');
        $kq = '';

        if ($a == 0) {
            $kq = ($b == 0) ? "Phương trình có vô số nghiệm" : "Phương trình vô nghiệm";
        } else {
            $kq = "Phương trình có nghiệm x = " . number_format(-$b / $a, 2);
        }

        return view('ptb1', ['kq' => $kq]);
    }
}
