@extends('layouts.app')
@section('content')
    <div
        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Manage Events</h1>
    </div>

    <div class="mb-3 pt-3 pb-2">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center">
            <h2 class="h4">Create new event</h2>
        </div>
    </div>
    <form class="needs-validation" novalidate action="{{route('events.store')}}" method="POST">
        @csrf
        @include('components.inputs.switch',[
            'label' => 'Active',
            'name' => 'active',
        ])
        @include('components.inputs.text',[
            'label' => 'Event Name',
            'name' => 'name',
        ])
        @include('components.inputs.text', [
            'label' => 'Slug',
            'name' => 'slug',
        ])
        @include('components.inputs.text',[
            'label' => 'Date',
            'name' => 'date',
            'placeholder' => 'yyyy-mm-dd',
        ])
        <hr class="mb-4">
        <button class="btn btn-primary" type="submit">Save event</button>
        <a href="#" class="btn btn-link">Cancel</a>
    </form>
@endsection
