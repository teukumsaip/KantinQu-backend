<?php

namespace App\Http\Controllers;

use App\Models\Food;
use Illuminate\Http\Request;
use App\Http\Requests\FoodRequest;

class FoodController extends Controller
{
    public function index()
    {
        $food = Food::paginate(10);

        return view('food.index', [
            'food' => $food
        ]);
    }

    public function create()
    {
        return view('food.create');
    }

    public function store(FoodRequest $request)
    {
        $data = $request->all();

        $data['picturePath'] = $request->file('picturePath')->store('assets/food', 'public');

        Food::create($data);

        return redirect()->route('food.index');
    }

    public function show(Food $food)
    {
        //
    }

    public function edit(Food $food)
    {
        return view('food.edit', [
            'item' => $food
        ]);
    }

    public function update(FoodRequest $request, Food $food)
    {
        $data = $request->all();

        if ($request->file('picturePath')) {
            $data['picturePath'] = $request->file('picturePath')->store('assets/food', 'public');
        }

        $food->update($data);

        return redirect()->route('food.index');
    }

    public function destroy(Food $food)
    {
        $food->delete();

        return redirect()->route('food.index');
    }
}
