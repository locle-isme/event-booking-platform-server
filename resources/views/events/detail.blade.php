@extends('layouts.app')
@section('content')
    <!-- Tickets -->
    <div id="tickets" class="mb-3 pt-3 pb-2">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center">
            <h2 class="h4">Tickets</h2>
            <div class="btn-toolbar mb-2 mb-md-0">
                <div class="btn-group mr-2">
                    <a href="{{route('tickets.create', ['event' => $event])}}" class="btn btn-sm btn-outline-secondary">
                        Create new ticket
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="row tickets">

        @foreach($event->tickets as $ticket)
            <div class="col-md-4">
                <div class="card mb-4 shadow-sm">
                    <div class="card-body">
                        <button type="button" class="close" aria-label="Close"
                                onclick="event.preventDefault(); document.getElementById('deleteTicketForm{{$ticket->id}}').submit()">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h5 class="card-title"><a href="{{route('tickets.edit', ['event' => $event, 'ticket' => $ticket])}}">{{$ticket->name}}</a></h5>
                        <p class="card-text">{{$ticket->cost}}.-</p>
                        <p class="card-text">{{$ticket->getDescription()}}</p>
                        <form id="deleteTicketForm{{$ticket->id}}"
                              action="{{route('tickets.destroy', ['event' => $event, 'ticket' => $ticket])}}"
                              method="post">
                            @csrf @method('delete')
                        </form>
                    </div>
                </div>
            </div>
        @endforeach

    </div>

    <!-- Sessions -->
    <div id="sessions" class="mb-3 pt-3 pb-2">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center">
            <h2 class="h4">Sessions</h2>
            <div class="btn-toolbar mb-2 mb-md-0">
                <div class="btn-group mr-2">
                    <a href="{{route('sessions.create', ['event' => $event])}}"
                       class="btn btn-sm btn-outline-secondary">
                        Create new session
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="table-responsive sessions">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>Time</th>
                <th>Type</th>
                <th class="w-100">Title</th>
                <th>Speakers</th>
                <th>Channel</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach($event->sessions as $session)
                <tr>
                    <td class="text-nowrap">{{$session->start}} - {{$session->end}}</td>
                    <td class="text-capitalize">{{$session->type}}</td>
                    <td>
                        <a href="{{route('sessions.edit', ['event' => $event, 'session' => $session])}}">{{$session->title}}</a>
                    </td>
                    <td class="text-nowrap">
                        {{$session->speakers}}
                    </td>
                    <td class="text-nowrap">{{$session->channel_room}}</td>
                    <td>
                        <button type="button" class="close" aria-label="Close"
                                onclick="event.preventDefault(); document.getElementById('deleteSessionForm{{$session->id}}').submit()">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <form id="deleteSessionForm{{$session->id}}"
                              action="{{route('sessions.destroy', ['event' => $event, 'session' => $session])}}"
                              method="post">
                            @csrf @method('delete')
                        </form>
                    </td>
                </tr>
            @endforeach

            </tbody>
        </table>
    </div>

    <!-- Channels -->
    <div id="channels" class="mb-3 pt-3 pb-2">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center">
            <h2 class="h4">Channels</h2>
            <div class="btn-toolbar mb-2 mb-md-0">
                <div class="btn-group mr-2">
                    <a href="{{route('channels.create', ['event' => $event])}}"
                       class="btn btn-sm btn-outline-secondary">
                        Create new channel
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="row channels">
        @foreach($event->channels as $channel)
            <div class="col-md-4">
                <div class="card mb-4 shadow-sm">
                    <div class="card-body">
                        <button type="button" class="close" aria-label="Close"
                                onclick="event.preventDefault(); document.getElementById('deleteChannelForm{{$channel->id}}').submit()">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <form id="deleteChannelForm{{$channel->id}}"
                              action="{{route('channels.destroy', ['event' => $event, 'channel' => $channel])}}"
                              method="post">
                            @csrf @method('delete')
                        </form>
                        <h5 class="card-title"><a
                                href="{{route('channels.edit', ['event' => $event, 'channel' => $channel])}}">{{$channel->name}}</a>
                        </h5>
                        <p class="card-text">{{$channel->sessions->count()}} sessions, {{$channel->rooms->count()}}
                            room</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Rooms -->
    <div id="rooms" class="mb-3 pt-3 pb-2">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center">
            <h2 class="h4">Rooms</h2>
            <div class="btn-toolbar mb-2 mb-md-0">
                <div class="btn-group mr-2">
                    <a href="{{route('rooms.create', ['event' => $event])}}" class="btn btn-sm btn-outline-secondary">
                        Create new room
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="table-responsive rooms">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>Name</th>
                <th>Capacity</th>
                <th></th>
            </tr>
            </thead>
            <tbody>

            @foreach($event->rooms as $room)
                <tr>
                    <td><a href="{{route('rooms.edit',['event' => $event, 'room' => $room])}}">{{$room->name}}</a>
                    </td>
                    <td>{{$room->capacity}}</td>
                    <td>
                        <button type="button" class="close" aria-label="Close"
                                onclick="event.preventDefault(); document.getElementById('deleteRoomForm{{$room->id}}').submit()">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <form id="deleteRoomForm{{$room->id}}"
                              action="{{route('rooms.destroy', ['event' => $event, 'room' => $room])}}"
                              method="post">
                            @csrf @method('delete')
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

@endsection
