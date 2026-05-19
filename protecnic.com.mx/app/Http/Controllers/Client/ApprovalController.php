<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Report;
use Illuminate\Http\Request;

class ApprovalController extends Controller
{
    public function show(string $token)
    {
        $report = Report::where('client_approval_token', $token)->firstOrFail();
        $report->load(['client', 'machine', 'product', 'photos', 'technician']);
        return view('client.approval', compact('report'));
    }

    public function approve(Request $request, string $token)
    {
        $report = Report::where('client_approval_token', $token)->firstOrFail();

        if ($report->client_approved_at) {
            return view('client.approval', compact('report'))
                ->with('info', 'Este reporte ya fue aprobado previamente.');
        }

        $report->update([
            'client_approved_at' => now(),
            'client_approval_ip' => $request->ip(),
            'status' => Report::STATUS_CLIENT_APPROVED,
        ]);

        return view('client.approved', compact('report'));
    }
}
