<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;

class CarController extends Controller
{
    public function index()
    {
        $cars = Car::all();
        return view('cars.index', compact('cars'));
    }

    public function create()
    {
        return view('cars.create');
    }

    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required',
            'model' => 'required',
            'description' => 'required',
            'release_date' => 'required|date',
        ]);

        // Create a new car record
        Car::create($request->all());

        return redirect()->route('cars.index')
            ->with('success', 'Car created successfully');
    }

    public function edit(Car $car)
    {
        return view('cars.edit', compact('car'));
    }

    public function update(Request $request, Car $car)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required',
            'model' => 'required',
            'description' => 'required',
            'release_date' => 'required|date',
        ]);

        // Update the car record
        $car->update($request->all());

        return redirect()->route('cars.index')
            ->with('success', 'Car updated successfully');
    }

    public function destroy(Car $car)
    {
        // Delete the car record
        $car->delete();

        return redirect()->route('cars.index')
            ->with('success', 'Car deleted successfully');
    }
}
