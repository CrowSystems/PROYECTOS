<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Machine;
use App\Models\Product;
use App\Models\Report;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        $stats = [
            'users' => User::count(),
            'brands' => Brand::count(),
            'machines' => Machine::count(),
            'products' => Product::count(),
            'reports_total' => Report::count(),
            'reports_pending' => Report::where('status', Report::STATUS_PENDING_CLIENT_APPROVAL)->count(),
            'reports_approved' => Report::whereIn('status', [
                Report::STATUS_CLIENT_APPROVED,
                Report::STATUS_SUPERVISOR_APPROVED,
            ])->count(),
            'my_reports' => Report::where('technician_id', $user->id)->count(),
        ];

        return view('dashboard', compact('stats'));
    }
}
