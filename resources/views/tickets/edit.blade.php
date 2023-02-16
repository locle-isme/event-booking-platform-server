@extends('layouts.app')
@section('content')
    <div class="mb-3 pt-3 pb-2">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center">
            <h2 class="h4">Edit ticket</h2>
        </div>
    </div>

    <form class="needs-validation" novalidate action="{{route('tickets.update', ['event' => $event, 'ticket' => $ticket])}}" method="POST">
        @csrf
        @method('PUT')
        @include('components.inputs.text', [
            'label' => 'Ticket Name',
            'name' => 'name',
            'value' => $ticket->getAttribute('name'),
        ])
        @include('components.inputs.text', [
            'label' => 'Cost',
            'name' => 'cost',
            'type' => 'number',
            'value' => $ticket->getAttribute('cost'),
        ])
        @include('components.inputs.select', [
            'label' => 'Special Validity',
            'name' => 'special_validity',
            'data' => $specialValidityData,
            'value' => $ticket->getAttribute('special_validity'),
        ])
        @include('components.inputs.text', [
            'label' => 'Maximum amount of tickets to be sold',
            'name' => 'amount',
            'type' => 'number',
            'value' => $ticket->getAttribute('amount'),
        ])
        @include('components.inputs.text', [
            'label' => 'Tickets can be sold until',
            'name' => 'date',
            'type' => 'date',
            'placeholder' => 'yyyy-mm-dd HH:MM',
            'value' => $ticket->getAttribute('date'),
        ])
        <hr class="mb-4">
        <button class="btn btn-primary" type="submit">Save ticket</button>
        <a href="#" class="btn btn-link">Cancel</a>
    </form>
@endsection
