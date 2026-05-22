<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;
use Illuminate\Support\Facades\Storage;

class EvenController extends Controller
{
    // INDEX
    public function index()
    {
        $events = Event::latest()->get();

        return view('admin.event.index', compact('events'));
    }


    // STORE
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
        ]);

        $data = $request->except('image');

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('events', 'public');
        }

        Event::create($data);

        return redirect()->back()
            ->with('success', 'Event Created Successfully');
    }


    // UPDATE
    public function update(Request $request, Event $event)
    {
        $request->validate([
            'title' => 'required|string|max:255',
        ]);

        $data = $request->except('image');

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($event->image) {
                Storage::disk('public')->delete($event->image);
            }

            $data['image'] = $request->file('image')->store('events', 'public');
        }

        $event->update($data);

        return redirect()->back()
            ->with('success', 'Event Updated Successfully');
    }


    // DESTROY
    public function destroy(Event $event)
    {
        if ($event->image) {
            Storage::disk('public')->delete($event->image);
        }

        $event->delete();

        return redirect()->back()
            ->with('success', 'Event Deleted Successfully');
    }
}