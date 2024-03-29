@extends('layouts.app')
@section('content')

    <div class="mb-3 pt-3 pb-2">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center">
            <h2 class="h4">Create new room</h2>
        </div>
    </div>

    <form class="needs-validation" novalidate action="{{route('rooms.store', $event)}}" method="POST">
        @csrf
        @include('components.inputs.text', [
            'label' => 'Name',
            'name' => 'name',
        ])
        @include('components.inputs.select', [
            'label' => 'Channel',
            'name' => 'channel',
            'data' => $channelData,
        ])
        @include('components.inputs.text',[
            'label' => 'Capacity',
            'type' => 'number',
            'name' => 'capacity',
        ])
        <hr class="mb-4">
        <button class="btn btn-primary" type="submit">Save room</button>
        <a href="#" class="btn btn-link">Cancel</a>
    </form>


@endsection
