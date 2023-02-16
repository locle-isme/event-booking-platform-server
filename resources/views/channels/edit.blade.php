@extends('layouts.app')
@section('content')
    <div class="mb-3 pt-3 pb-2">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center">
            <h2 class="h4">Edit channel</h2>
        </div>
    </div>
    <form class="needs-validation" novalidate
          action="{{route('channels.update', ['event' => $event, 'channel' => $channel])}}" method="post">
        @csrf
        @method('PUT')
        @include('components.inputs.text', [
            'label' => 'Name',
            'name' => 'name',
            'value' => $channel->name,
        ])
        <hr class="mb-4">
        <button class="btn btn-primary" type="submit">Save channel</button>
        <a href="#" class="btn btn-link">Cancel</a>
    </form>
@endsection
