<?php

namespace App\Http\Controllers;

use App\Event;
use App\Http\Requests\CreateTicketRequest;
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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Event $event, CreateTicketRequest $request)
    {
        //
        $data = $request->validated();
        if (isset($data['amount'])) {
            $data['special_validity'] = json_encode(
                [
                    'type' => 'amount',
                    'amount' => $data['amount']
                ]
            );
        } else if (isset($data['date'])) {
            $data['special_validity'] = json_encode(
                [
                    'type' => 'date',
                    'date' => $data['date']
                ]
            );
        }

        unset($data['date'], $data['amount']);
        $event->tickets()->create($data);
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
     * @param \App\Ticket $ticket
     * @return \Illuminate\Http\Response
     */
    public function edit(Ticket $ticket)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Ticket $ticket
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ticket $ticket)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Ticket $ticket
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ticket $ticket)
    {
        //
    }
}
