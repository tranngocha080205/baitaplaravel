<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;
use App\Models\Mf;

class CarController extends Controller
{
    public function index()
    {
        $cars = Car::with('mf')->get();
        return view('car.carlist', compact('cars'));
    }

    public function create()
    {
        $mfs = Mf::all(); // Lấy danh sách các nhà sản xuất
        return view('car.create', compact('mfs'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'make' => 'required|string|max:30',
            'model' => 'required|string|max:100',
            'produced_on' => 'required|date',
            'mf_id' => 'required|exists:mfs,id',
        ]);

        Car::create($validatedData);
        return redirect()->route('cars.index')->with('success', 'Car added successfully!');
    }

    public function edit($id)
    {
        $car = Car::findOrFail($id);
        $mfs = Mf::all();
        return view('car.edit', compact('car', 'mfs'));
    }

    public function update(Request $request, $id)
    {
        $car = Car::findOrFail($id);

        $validatedData = $request->validate([
            'make' => 'required|string|max:30',
            'model' => 'required|string|max:100',
            'produced_on' => 'required|date',
            'mf_id' => 'required|exists:mfs,id',
        ]);

        $car->update($validatedData);
        return redirect()->route('cars.index')->with('success', 'Car updated successfully!');
    }

    public function destroy($id)
    {
        $car = Car::findOrFail($id);
        $car->delete();
        return redirect()->route('cars.index')->with('success', 'Car deleted successfully!');
    }
}
