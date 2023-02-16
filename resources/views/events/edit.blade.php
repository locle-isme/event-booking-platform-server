@extends('layouts.app')
@section('content')

    <form class="needs-validation" novalidate action="{{route('events.update', $event)}}" method="post">
        @method('put')
        @csrf
        @include('components.inputs.switch',[
            'label' => 'Active',
            'name' => 'active',
            'value' => $event->getAttribute('active'),
        ])
        @include('components.inputs.text',[
            'label' => 'Event Name',
            'name' => 'name',
            'value' => $event->getAttribute('name'),
        ])
        @include('components.inputs.text', [
            'label' => 'Slug',
            'name' => 'slug',
            'value' => $event->getAttribute('slug'),
        ])
        @include('components.inputs.text',[
            'label' => 'Date',
            'name' => 'date',
            'placeholder' => 'yyyy-mm-dd',
            'value' => $event->getAttribute('date'),
        ])
        <hr class="mb-4">
        <button class="btn btn-primary" type="submit">Save event</button>
        <a href="#" class="btn btn-link">Cancel</a>
    </form>
@endsection
