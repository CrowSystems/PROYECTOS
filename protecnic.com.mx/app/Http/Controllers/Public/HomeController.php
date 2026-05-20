<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Event;
use App\Models\Machine;
use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        return view('public.home', [
            'brands'   => Brand::forCarousel()->get(),
            'machines' => Machine::where('active', true)->with('brand')->latest()->take(8)->get(),
            'products' => Product::where('active', true)->with('brand')->latest()->take(8)->get(),
            'events'   => Event::published()->orderByDesc('event_date')->orderByDesc('id')->take(4)->get(),
        ]);
    }
}
