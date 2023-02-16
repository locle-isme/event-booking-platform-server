@extends('layouts.app')
@section('content')

    <div class="mb-3 pt-3 pb-2">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center">
            <h2 class="h4">Edit room</h2>
        </div>
    </div>

    <form class="needs-validation" novalidate action="{{route('rooms.update',['event' => $event, 'room' => $room])}}"
          method="POST">
        @csrf
        @method('PUT')
        @include('components.inputs.text', [
            'label' => 'Name',
            'name' => 'name',
            'value' => $room->getAttribute('name'),
        ])
        @include('components.inputs.select', [
            'label' => 'Channel',
            'name' => 'channel',
            'data' => $channelData,
            'value' => $room->getAttribute('channel')->id
        ])
        @include('components.inputs.text',[
            'label' => 'Capacity',
            'type' => 'number',
            'name' => 'capacity',
            'value' => $room->getAttribute('capacity'),
        ])
        <hr class="mb-4">
        <button class="btn btn-primary" type="submit">Save room</button>
        <a href="#" class="btn btn-link">Cancel</a>
    </form>


@endsection
