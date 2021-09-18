@extends('layouts.app')
@section('content')

    <form class="needs-validation" novalidate action="{{route('events.update', $event)}}" method="post">
        @method('put')
        @csrf
        @include('components.inputs.switch',[ 'label' => 'Active', 'name' => config('constants.event.active'), 'value' => $event->{config('constants.event.active')} ])
        @include('components.inputs.text',[ 'label' => 'Name', 'name' => config('constants.event.name'), 'value' => $event->{config('constants.event.name')} ])
        @include('components.inputs.text',[ 'label' => 'Slug', 'name' => config('constants.event.slug'), 'value' => $event->{config('constants.event.slug')}, ])
        @include('components.inputs.text',[ 'label' => 'Date', 'name' => config('constants.event.date'), 'type' => 'date', 'placeholder' => 'yyyy-mm-dd', 'value' => $event->{config('constants.event.date')}, ])
        <hr class="mb-4">
        <button class="btn btn-primary" type="submit">Save event</button>
        <a href="#" class="btn btn-link">Cancel</a>
    </form>
@endsection
