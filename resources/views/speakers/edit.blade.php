@extends('layouts.app')
@section('content')
    <div class="mb-3 pt-3 pb-2">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center">
            <h2 class="h4">Edit speaker</h2>
        </div>
    </div>

    <form class="needs-validation" enctype="multipart/form-data" novalidate
          action="{{route('speakers.update', $speaker)}}" method="post">
        @csrf
        @method('put')
        @include('components.inputs.text',[ 'label' => 'Name', 'name' => config('constants.speaker.name'), 'value' => $speaker->{config('constants.speaker.name')}, ])
        @include('components.inputs.text',[ 'label' => 'Birthday', 'name' => config('constants.speaker.birthday'), 'placeholder' => 'yyyy-mm-dd', 'value' => $speaker->{config('constants.speaker.birthday')}, ])
        @include('components.inputs.text',[ 'label' => 'Social linking', 'name' => config('constants.speaker.social_linking'), 'placeholder' => 'Example: https://www.facebook.com/LocLe.isme', 'value' => $speaker->{config('constants.speaker.social_linking')}, ])
        @include('components.inputs.text',[ 'label' => 'Avatar', 'name' => config('constants.speaker.avatar'), 'type' => 'file', 'class' => 'form-control-file', ])
        @include('components.inputs.textarea',[ 'label' => 'Description', 'name' => config('constants.speaker.description'), 'colLeft' => 12, 'placeholder' => 'Write something about you . . .', 'value' => $speaker->{config('constants.speaker.description')}, ])
        <hr class="mb-4">
        <button class="btn btn-primary" type="submit">Save session</button>
        <a href="events/detail.html" class="btn btn-link">Cancel</a>
    </form>
@endsection
