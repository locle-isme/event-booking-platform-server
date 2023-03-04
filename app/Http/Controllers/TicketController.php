<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Http\Requests\Ticket\StoreRequest;
use App\Models\Ticket;

class TicketController extends Controller
{
    public function create(Event $event)
    {
        $specialValidityData = ['' => 'None'] + config('constants.common.special_validity_data');
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
        $specialValidityData = ['' => 'None'] + config('constants.common.special_validity_data');
        $amount = @$specialValidity['amount'];
        $ticket->amount = is_numeric($amount) ? $amount : null;
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

    private function formatSpecialValidity($data)
    {
        if (empty($data['special_validity'])) {
            return null;
        }
        $specialValidity = @$data['special_validity'];
        if (!in_array($specialValidity, ['date', 'amount'])) {
            return null;
        }
        $result = [
            'type' => $specialValidity,
            $specialValidity => $data[$specialValidity]
        ];
        return json_encode($result);
    }
}
