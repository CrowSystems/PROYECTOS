<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Event;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::published()
            ->orderByDesc('event_date')
            ->orderByDesc('id')
            ->paginate(12);

        return view('public.events.index', compact('events'));
    }

    public function show(Event $event)
    {
        abort_unless($event->published, 404);
        $event->load(['images', 'brands']);
        return view('public.events.show', compact('event'));
    }
}
