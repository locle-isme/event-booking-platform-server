@extends('layouts.app')
@section('content')

    <div class="mb-3 pt-3 pb-2">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center">
            <h2 class="h4">Edit room</h2>
        </div>
    </div>

    <form class="needs-validation" novalidate action="{{route('rooms.update',['event' => $event, 'room' => $room])}}"
          method="post">
        @csrf
        @method('put')
        @include('components.inputs.text',[ 'label' => 'Name', 'name' => config('constants.room.name'), 'value' => $room->{config('constants.room.name')} ])
        @include('components.inputs.select', ['label' => 'Channel', 'name' => config('constants.room.channel'), 'data' => $channels, 'value' => $room->channel->id ])
        @include('components.inputs.text',[ 'label' => 'Capacity', 'type' => 'number', 'name' => config('constants.room.capacity'), 'value' => $room->{config('constants.room.capacity')} ])
        <hr class="mb-4">
        <button class="btn btn-primary" type="submit">Save room</button>
        <a href="#" class="btn btn-link">Cancel</a>
    </form>


@endsection
