@extends('layouts.app')
@section('content')
    <div class="mb-3 pt-3 pb-2">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center">
            <h2 class="h4">Create new ticket</h2>
        </div>
    </div>

    <form class="needs-validation" novalidate action="{{route('tickets.store', $event)}}" method="POST">
        @csrf
        @include('components.inputs.text', [
            'label' => 'Ticket Name',
            'name' => 'name',
        ])
        @include('components.inputs.text', [
            'label' => 'Cost',
            'name' => 'cost',
            'type' => 'number',
            'value' => 0,
        ])
        @include('components.inputs.select', [
            'label' => 'Special Validity',
            'name' => 'special_validity',
            'data' => $specialValidityData,
        ])
        @include('components.inputs.text', [
            'label' => 'Maximum amount of tickets to be sold',
            'name' => 'amount',
            'type' => 'number',
            'value' => 0,
        ])
        @include('components.inputs.text', [
            'label' => 'Tickets can be sold until',
            'name' => 'date',
            'placeholder' => 'Y-m-d',
        ])
        <hr class="mb-4">
        <button class="btn btn-primary" type="submit">Save ticket</button>
        <a href="#" class="btn btn-link">Cancel</a>
    </form>
@endsection
