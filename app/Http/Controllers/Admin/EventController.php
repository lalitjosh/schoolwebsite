<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        return view('admin.events', [
            'items' => Event::query()->latest('event_date')->paginate(10),
            'item' => new Event(),
        ]);
    }

    public function store(Request $request)
    {
        Event::create($this->validated($request, null));

        return redirect()->route('admin.events.index')->with('success', 'Event added.');
    }

    public function edit(Event $event)
    {
        return view('admin.events', [
            'items' => Event::query()->latest('event_date')->paginate(10),
            'item' => $event,
        ]);
    }

    public function update(Request $request, Event $event)
    {
        $event->update($this->validated($request, $event));

        return redirect()->route('admin.events.index')->with('success', 'Event updated.');
    }

    public function destroy(Event $event)
    {
        $event->delete();

        return redirect()->route('admin.events.index')->with('success', 'Event deleted.');
    }

    private function validated(Request $request, ?Event $event): array
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:180'],
            'description' => ['nullable', 'string'],
            'event_date' => ['nullable', 'date'],
            'location' => ['nullable', 'string', 'max:180'],
            'image' => ['nullable', 'image', 'max:2048'],
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('events', 'public');
        } else {
            unset($data['image']);
        }

        return $data;
    }
}
