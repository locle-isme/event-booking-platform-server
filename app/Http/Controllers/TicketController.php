<?php

namespace App\Http\Controllers;

use App\Event;
use App\Http\Requests\CreateTicketRequest;
use App\Http\Requests\UpdateTicketRequest;
use App\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Event $event)
    {
        //
        return view('tickets.create', compact('event'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Event $event
     * @param CreateTicketRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(Event $event, CreateTicketRequest $request)
    {
        //
        $validated = $request->validated();
        $validated['special_validity'] = $this->formatSpecialValidity($validated);
        unset($validated['date'], $validated['amount']);
        $event->tickets()->create($validated);
        return redirect()->route('events.show', $event)->with('message', 'Ticket successfully created');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Ticket $ticket
     * @return \Illuminate\Http\Response
     */
    public function show(Ticket $ticket)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Event $event
     * @param \App\Ticket $ticket
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event, Ticket $ticket)
    {
        //
        $ticket->cost = (int)$ticket->cost;
        $ticket->amount = null;
        $ticket->date = null;
        $ticket->special_validity_type = $ticket->getSV() ? $ticket->getSV()->type : null;
        $ticket->amount = $ticket->getSV() && $ticket->getSV()->type == 'amount' ? $ticket->getSV()->amount : null;
        $ticket->date = $ticket->getSV() && $ticket->getSV()->type == 'date' ? $ticket->getSV()->date : null;
        return view('tickets.edit', compact('event', 'ticket'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Event $event
     * @param \App\Ticket $ticket
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTicketRequest $request, Event $event, Ticket $ticket)
    {
        //
        $validated = $request->validated();
        $isExist = $ticket->registrations->count();
        if ($isExist && $ticket->getSV() && $ticket->getSV()->amount) {
            return redirect()->route('events.show', $event)->with('error-message', 'This ticket is used');
        }
        $validated['special_validity'] = $this->formatSpecialValidity($validated);
        unset($validated['date'], $validated['amount']);
        $ticket->update($validated);
        return redirect()->route('events.show', $event)->with('message', 'Ticket successfully updated');
    }

    private function formatSpecialValidity($validated)
    {
        if (isset($validated['amount'])) {
            return json_encode(
                [
                    'type' => 'amount',
                    'amount' => $validated['amount']
                ]
            );
        } else if (isset($validated['date'])) {
            return json_encode(
                [
                    'type' => 'date',
                    'date' => $validated['date']
                ]
            );
        }
        return null;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Event $event
     * @param \App\Ticket $ticket
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event, Ticket $ticket)
    {
        //
        $isExist = $ticket->registrations->count();
        if ($isExist) {
            return redirect()->route('events.show', $event)->with('error-message', 'This ticket is used');
        }

        $ticket->delete();
        return redirect()->route('events.show', $event)->with('message', 'Ticket successfully deleted');
    }
}
