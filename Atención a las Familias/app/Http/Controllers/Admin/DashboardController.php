<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use App\Models\Program;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'programs_total'  => Program::count(),
            'programs_active' => Program::where('is_active', true)->count(),
            'messages_total'  => ContactMessage::count(),
            'messages_unread' => ContactMessage::where('is_read', false)->count(),
        ];

        $latestMessages = ContactMessage::latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'latestMessages'));
    }
}
