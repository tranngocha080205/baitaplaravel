<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RestaurantController extends Controller
{
    /**
     * Hiển thị danh sách nhà hàng.
     */
    public function index()
    {
        $restaurants = Restaurant::all();
        return view('restaurants.index', compact('restaurants'));
    }

    /**
     * Hiển thị form thêm nhà hàng mới.
     */
    public function create()
    {
        return view('restaurants.create');
    }

    /**
     * Lưu nhà hàng mới vào database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'img' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'nullable|string',
        ]);

        $data = $request->all();

        if ($request->hasFile('img')) {
            $data['img'] = $request->file('img')->store('restaurants', 'public');
        }

        Restaurant::create($data);
        return redirect()->route('restaurants.index')->with('success', 'Nhà hàng đã được thêm thành công!');
    }

    /**
     * Hiển thị chi tiết một nhà hàng.
     */
    public function show($id)
    {
        $restaurant = Restaurant::findOrFail($id);
        return view('restaurants.show', compact('restaurant'));
    }

    /**
     * Hiển thị form chỉnh sửa nhà hàng.
     */
    public function edit($id)
    {
        $restaurant = Restaurant::findOrFail($id);
        return view('restaurants.edit', compact('restaurant'));
    }

    /**
     * Cập nhật thông tin nhà hàng.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'img' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'nullable|string',
        ]);

        $restaurant = Restaurant::findOrFail($id);
        $restaurant->name = $request->name;
        $restaurant->address = $request->address;
        $restaurant->description = $request->description;

        // Xử lý ảnh nếu có ảnh mới
        if ($request->hasFile('img')) {
            if ($restaurant->img) {
                Storage::disk('public')->delete($restaurant->img);
            }
            $restaurant->img = $request->file('img')->store('restaurants', 'public');
        }

        $restaurant->save();
        return redirect()->route('restaurants.index')->with('success', 'Cập nhật thành công!');
    }

    /**
     * Xóa nhà hàng.
     */
    public function destroy($id)
    {
        $restaurant = Restaurant::findOrFail($id);

        // Xóa ảnh nếu có
        if ($restaurant->img) {
            Storage::disk('public')->delete($restaurant->img);
        }

        $restaurant->delete();
        return redirect()->route('restaurants.index')->with('success', 'Nhà hàng đã bị xóa thành công!');
    }
}
