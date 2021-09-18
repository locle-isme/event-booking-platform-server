@extends('layouts.app')
@section('content')
    <div class="mb-3 pt-3 pb-2">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center">
            <h2 class="h4">Edit ticket</h2>
        </div>
    </div>

    <form class="needs-validation" novalidate
          action="{{route('tickets.update', ['event' => $event, 'ticket' => $ticket])}}" method="post">
        @csrf
        @method('put')
        @include('components.inputs.text',[ 'label' => 'Name', 'name' => config('constants.ticket.name'), 'value' => $ticket->{config('constants.ticket.name')} ])
        @include('components.inputs.text',[ 'label' => 'Cost', 'name' => config('constants.ticket.cost'), 'type' => 'number', 'value' => $ticket->{config('constants.ticket.cost')}, ])
        @include('components.inputs.select',[ 'label' => 'Special Validity', 'name' => config('constants.ticket.special_validity'), 'data' => config('constants.ticket.special_validity_data'), 'value' => $ticket->{config('constants.ticket.special_validity')}, ])
        @include('components.inputs.text',[ 'label' => 'Maximum amount of tickets to be sold', 'name' => config('constants.ticket.amount'), 'type' => 'number', 'value' => $ticket->{config('constants.ticket.amount')}, ])
        @include('components.inputs.text',[ 'label' => 'Tickets can be sold until', 'name' => config('constants.ticket.date'), 'type' => 'date', 'placeholder' => 'yyyy-mm-dd HH:MM', 'value' => $ticket->{config('constants.ticket.date')}, ])
        <hr class="mb-4">
        <button class="btn btn-primary" type="submit">Save ticket</button>
        <a href="#" class="btn btn-link">Cancel</a>
    </form>

@endsection
