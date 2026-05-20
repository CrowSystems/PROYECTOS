<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Machine;
use App\Models\Product;

class PagesController extends Controller
{
    public function products()
    {
        $items = Product::where('active', true)->with('brand')->paginate(24);
        return view('public.pages.products', compact('items'));
    }

    public function services()
    {
        return view('public.pages.services');
    }

    public function consumables()
    {
        $items = Product::where('active', true)
            ->where('product_type', 'Consumible')
            ->with('brand')
            ->paginate(24);
        return view('public.pages.consumables', compact('items'));
    }

    public function accessories()
    {
        $items = Product::where('active', true)
            ->where('product_type', 'Accesorio')
            ->with('brand')
            ->paginate(24);
        return view('public.pages.accessories', compact('items'));
    }

    public function laboratory()
    {
        return view('public.pages.laboratory');
    }

    public function about()
    {
        return view('public.pages.about');
    }

    public function blog()
    {
        return view('public.pages.blog');
    }
}
