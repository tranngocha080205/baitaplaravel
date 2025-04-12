<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    // Hiển thị danh sách
    public function index()
    {
        $categories = Category::all();
        return view('banhang.cate-list', compact('categories'));
    }

    // Hiển thị form thêm mới
    public function create()
    {
        return view('banhang.cate-add');
    }

    // Lưu dữ liệu mới
    public function store(Request $request)
    {
        $category = new Category();
        $category->name = $request->name;
        $category->description = $request->description;
        $category->image = $request->image;
        $category->save();

        return redirect()->route('category.index')->with('success', 'Thêm danh mục thành công!');
    }

    // Hiển thị form sửa
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.category.cate-edit', compact('category'));
    }

    // Cập nhật dữ liệu
    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);
        $category->update($request->only(['name', 'description', 'image']));

        return redirect()->route('category.index')->with('success', 'Cập nhật thành công!');
    }

    // Xoá danh mục
    public function destroy($id)
    {
        Category::destroy($id);
        return redirect()->route('category.index')->with('success', 'Xóa danh mục thành công!');
    }
}
