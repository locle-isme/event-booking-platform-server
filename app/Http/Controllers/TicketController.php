<?php

namespace App\Http\Controllers;

use App\Event;
use App\Http\Requests\CreateTicketRequest;
use App\Http\Requests\Ticket\StoreRequest;
use App\Http\Requests\UpdateTicketRequest;
use App\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function create(Event $event)
    {
        return view('tickets.create', compact('event'));
    }

    public function store(StoreRequest $request, Event $event)
    {
        $validated = $request->validated();
        $validated['special_validity'] = $this->formatSpecialValidity($validated);
        unset($validated['date'], $validated['amount']);
        $event->tickets()->create($validated);
        return redirect()->route('events.show', $event)->with('message', 'Ticket successfully created');
    }

    public function edit(Event $event, Ticket $ticket)
    {
        $sv = $ticket->getSV();
        $ticket->cost = (int)$ticket->cost;
        $ticket->special_validity = $sv['type'] ?? null;
        $ticket->amount = $sv['amount'] ?? null;
        $ticket->date = $sv['date'] ?? null;
        return view('tickets.edit', compact('event', 'ticket'));
    }

    public function update(StoreRequest $request, Event $event, Ticket $ticket)
    {
        $validated = $request->validated();
        $validated['special_validity'] = $this->formatSpecialValidity($validated);
        unset($validated['date'], $validated['amount']);
        $ticket->update($validated);
        return redirect()->route('events.show', $event)->with('message', 'Ticket successfully updated');
    }

    public function destroy(Event $event, Ticket $ticket)
    {
        $isExist = $ticket->registrations->count();
        if ($isExist) {
            return redirect()->route('events.show', $event)->with('error-message', 'This ticket is used');
        }

        $ticket->delete();
        return redirect()->route('events.show', $event)->with('message', 'Ticket successfully deleted');
    }

    private function formatSpecialValidity($validated)
    {
        if (empty($validated['special_validity'])) return null;
        $specialValidity = $validated['special_validity'];
        if (!in_array($specialValidity, ['date', 'amount'])) return null;
        $data = [
            'type' => $specialValidity,
            $specialValidity => $validated[$specialValidity]
        ];
        return json_encode($data);
    }
}
