<?php

namespace App\Http\Controllers;

use App\Models\Price;
use Illuminate\Http\Request;

class PriceController extends Controller
{
    public function index()
    {
        $prices = Price::all();
        return view('admin.prices.index', compact('prices'));
    }
    public function show(Price $price)
    {
        return view('admin.prices.edit', compact('price'));
    }
    public function update(Price $price)
    {
        request()->validate([
            'price' => 'required'
        ]);
        $price->update([
            'price' => request('price')
        ]);
        return back()->with('price_updated', 'Price updated successfully.');
    }
}
