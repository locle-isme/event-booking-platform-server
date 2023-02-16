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
        $specialValidityData = ['' => 'None'] + config('constants.ticket.special_validity_data');
        return view('tickets.create', [
            'event' => $event,
            'specialValidityData' => $specialValidityData
        ]);
    }

    public function store(StoreRequest $request, Event $event)
    {
        try {
            $validated = $request->validated();
            $validated['special_validity'] = $this->formatSpecialValidity($validated);
            unset($validated['date'], $validated['amount']);
            $event->tickets()->create($validated);
            return redirect()->route('events.show', $event)->with('message', 'Ticket successfully created');
        } catch (\Throwable $e) {
            return redirect()->route('events.index', $event)->with('error-message', 'Something error please retry again!');
        }
    }

    public function edit(Event $event, Ticket $ticket)
    {
        $specialValidity = $ticket->getSV();
        $ticket->cost = (int)$ticket->getAttribute('cost');
        $ticket->special_validity = @$specialValidity['type'];
        $specialValidityVal = @$specialValidity['type'];
        $specialValidityData = ['' => 'None'] + config('constants.ticket.special_validity_data');
        $ticket->amount = @$specialValidity['amount'] ?: 0;
        $ticket->date = @$specialValidity['date'];
        return view('tickets.edit', [
            'event' => $event,
            'ticket' => $ticket,
            'specialValidityVal' => $specialValidityVal,
            'specialValidityData' => $specialValidityData
        ]);
    }

    public function update(StoreRequest $request, Event $event, Ticket $ticket)
    {
        try {
            $validated = $request->validated();
            $validated['special_validity'] = $this->formatSpecialValidity($validated);
            unset($validated['date'], $validated['amount']);
            $ticket->update($validated);
            return redirect()->route('events.show', $event)->with('message', 'Ticket successfully updated');
        } catch (\Throwable $e) {
            return redirect()->route('events.index', $event)->with('error-message', 'Something error please retry again!');
        }
    }

    public function destroy(Event $event, Ticket $ticket)
    {
        try {
            $isExist = $ticket->registrations->count();
            if ($isExist) {
                return redirect()->route('events.show', $event)->with('error-message', 'This ticket is used');
            }
            $ticket->delete();
            return redirect()->route('events.show', $event)->with('message', 'Ticket successfully deleted');
        } catch (\Throwable $e) {
            return redirect()->route('events.index', $event)->with('error-message', 'Something error please retry again!');
        }
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
