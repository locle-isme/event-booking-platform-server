@extends('layouts.app')
@section('content')
    <div class="mb-3 pt-3 pb-2">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center">
            <h2 class="h4">Create new channel</h2>
        </div>
    </div>

    <form class="needs-validation" novalidate action="{{route('channels.store', $event)}}" method="post">
        @csrf
        @include('components.inputs.text', [
            'label' => 'Name',
            'name' => 'name',
        ])
        <hr class="mb-4">
        <hr class="mb-4">
        <button class="btn btn-primary" type="submit">Save channel</button>
        <a href="#" class="btn btn-link">Cancel</a>
    </form>

@endsection
