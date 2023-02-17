@extends('layouts.app')
@section('content')
    <div class="mb-3 pt-3 pb-2">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center">
            <h2 class="h4">Create new session</h2>
        </div>
    </div>

    <form class="needs-validation" novalidate action="{{route('sessions.store', $event)}}" method="post">
        @csrf
        @include('components.inputs.select', [
            'label' => 'Type',
            'name' => 'type',
            'data' => config('constants.common.session_type_data'),
        ])
        @include('components.inputs.text', [
            'label' => 'Title',
            'name' => 'title',
        ])
        @include('components.inputs.select', [
            'label' => 'Speakers',
            'multiple' => true,
            'name' => 'speakers',
            'data' => $speakers,
        ])
        @include('components.inputs.select', [
            'label' => 'Room',
            'name' => 'room',
            'data' => $roomData,
        ])
        @include('components.inputs.text', [
            'label' => 'Cost',
            'name' => 'cost',
            'type' => 'number',
        ])
        <div class="row">
            <div class="col-12 col-lg-6 mb-3">
                @include('components.inputs.text', [
                    'label' => 'Start',
                    'colLeft' => 12,
                    'name' => 'start',
                    'placeholder' => 'yyyy-mm-dd HH:MM',
                ])
            </div>
            <div class="col-12 col-lg-6 mb-3">
                @include('components.inputs.text', [
                    'label' => 'End',
                    'colLeft' => 12,
                    'name' => 'end',
                    'placeholder' => 'yyyy-mm-dd HH:MM',
                ])
            </div>
        </div>
        @include('components.inputs.textarea', [
            'colLeft' => 12,
            'label' => 'Description',
            'name' => 'description',
            'placeholder' => 'Write something . . .',
        ])
        <hr class="mb-4">
        <button class="btn btn-primary" type="submit">Save session</button>
        <a href="#" class="btn btn-link">Cancel</a>
    </form>
@endsection
