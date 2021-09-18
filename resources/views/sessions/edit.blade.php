@extends('layouts.app')
@section('content')
    <div class="mb-3 pt-3 pb-2">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center">
            <h2 class="h4">Edit session</h2>
        </div>
    </div>

    <form class="needs-validation" novalidate
          action="{{route('sessions.update', ['event' => $event, 'session' => $session])}}" method="post">
        @csrf
        @method('put')
        @include('components.inputs.select',[ 'label' => 'Type', 'name' => config('constants.session.type'), 'data' => config('constants.session.type_data'), 'value' => $session->{config('constants.session.type')}, ])
        @include('components.inputs.text',[ 'label' => 'Title', 'name' => config('constants.session.title'), 'value' => $session->{config('constants.session.title')}, ])
        @include('components.inputs.select',[ 'label' => 'Speakers', 'multiple' => true, 'name' => config('constants.session.speakers'), 'data' => $speakers, 'value' => $sessionSpeakers ])
        @include('components.inputs.select',[ 'label' => 'Room', 'name' => config('constants.session.room'), 'data' => $rooms, 'value' => $session->{config('constants.session.room')}, ])
        @include('components.inputs.text',[ 'label' => 'Cost', 'name' => config('constants.session.cost'), 'type' => 'number', 'value' => $session->{config('constants.session.cost')}, ])
        <div class="row">
            <div class="col-12 col-lg-6 mb-3">
                @include('components.inputs.text',[ 'label' => 'Start', 'colLeft' => 12, 'name' => config('constants.session.start'), 'placeholder' => 'yyyy-mm-dd HH:MM', 'value' => $session->{config('constants.session.start')}, ])
            </div>
            <div class="col-12 col-lg-6 mb-3">
                @include('components.inputs.text',[ 'label' => 'End', 'colLeft' => 12, 'name' => config('constants.session.end'), 'placeholder' => 'yyyy-mm-dd HH:MM', 'value' => $session->{config('constants.session.end')}, ])
            </div>
        </div>
        @include('components.inputs.textarea',[ 'colLeft' => 12, 'label' => 'Description', 'name' => 'description', 'placeholder' => 'Write something . . .', 'value' => $session->description, ])
        <hr class="mb-4">
        <button class="btn btn-primary" type="submit">Save session</button>
        <a href="#" class="btn btn-link">Cancel</a>
    </form>
@endsection
