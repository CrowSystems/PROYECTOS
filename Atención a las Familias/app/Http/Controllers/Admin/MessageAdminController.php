<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;

class MessageAdminController extends Controller
{
    public function index()
    {
        $messages = ContactMessage::latest()->paginate(20);
        return view('admin.messages.index', compact('messages'));
    }

    public function show(ContactMessage $message)
    {
        if (!$message->is_read) {
            $message->update(['is_read' => true]);
        }
        return view('admin.messages.show', compact('message'));
    }

    public function toggleRead(ContactMessage $message)
    {
        $message->update(['is_read' => !$message->is_read]);
        return back();
    }

    public function destroy(ContactMessage $message)
    {
        $message->delete();
        return redirect()
            ->route('admin.messages.index')
            ->with('success', 'Mensaje eliminado.');
    }
}
