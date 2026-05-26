<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Support\Str;

class EventController extends Controller
{
    private function getEventField(Event $event, string $field): ?string
    {
        $locale = app()->getLocale();
        $localizedField = $field . '_' . $locale;

        if (in_array($locale, ['km', 'cn'], true) && !empty($event->{$localizedField})) {
            return $event->{$localizedField};
        }

        return $event->{$field};
    }

    private function mapEvent(Event $event, int $index): array
    {
        $colors = ['blue', 'teal', 'amber', 'purple', 'orange'];
        $color = $colors[$index % count($colors)];

        return [
            'id' => $event->id,
            'num' => str_pad((string) ($index + 1), 2, '0', STR_PAD_LEFT),
            'slug' => Str::slug($this->getEventField($event, 'title') ?: 'event-' . $event->id),
            'title' => $this->getEventField($event, 'title'),
            'tag' => $event->category ?: 'Event',
            'color' => $color,
            'badge' => $this->getEventField($event, 'badge') ?: 'Featured Event',
            'desc' => $this->getEventField($event, 'short_description'),
            'description' => $this->getEventField($event, 'description'),
            'features' => $this->getEventField($event, 'features'),
            'image' => $event->image,
            'brand' => $event->brand,
            'category' => $event->category,
            'availability' => $event->availability,
            'cta_question' => $event->cta_question,
            'cta_title' => $event->cta_title,
            'cta_url' => $event->cta_url,
        ];
    }

    private function getEvents()
    {
        return Event::query()
            ->where('status', 1)
            ->latest()
            ->get()
            ->values()
            ->map(fn (Event $event, int $index) => $this->mapEvent($event, $index));
    }

    public function index()
    {
        $events = $this->getEvents();

        return view('frontends.eventPage.index', compact('events'));
    }

    public function show($slug)
    {
        $articles = $this->getEvents();
        $current = collect($articles)->firstWhere('slug', $slug);

        if (!$current) {
            abort(404);
        }

        return view('frontends.eventPage.show', compact('slug', 'articles', 'current'));
    }
}
