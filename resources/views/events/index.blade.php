@extends('layouts.app')
@section('content')
    <div
        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Manage Events</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group mr-2">
                <a href="{{route('events.create')}}" class="btn btn-sm btn-outline-secondary">Create new event</a>
            </div>
        </div>
    </div>

    <div class="row events">
        @foreach($events as $e)
            <div class="col-md-4">
                <div class="card mb-4 shadow-sm">
                    <a href="{{route('events.show', [$e->id])}}" class="btn text-left event">
                        <div class="card-body">
                            <button type="button" class="close" aria-label="Close"
                                    onclick="event.preventDefault(); document.getElementById('deleteEventForm{{$e->id}}').submit()">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <form id="deleteEventForm{{$e->id}}"
                                  action="{{route('events.destroy', ['event' => $e])}}"
                                  method="post">
                                @csrf @method('delete')
                            </form>
                            <h5 class="card-title">{{$e->name}}</h5>
                            <p class="card-subtitle">{{$e->date}}</p>
                            <hr>
                            <p class="card-text">{{$e->registrations->count()}} registrations</p>
                        </div>
                    </a>
                </div>
            </div>
        @endforeach
    </div>

@endsection
