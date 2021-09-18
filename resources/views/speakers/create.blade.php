@extends('layouts.app')
@section('content')
    <div class="mb-3 pt-3 pb-2">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center">
            <h2 class="h4">Create new speaker</h2>
        </div>
    </div>

    <form class="needs-validation" enctype="multipart/form-data" novalidate action="{{route('speakers.store')}}"
          method="post">
        @csrf
        @include('components.inputs.text',[ 'label' => 'Name', 'name' => config('constants.speaker.name') ])
        @include('components.inputs.text',[ 'label' => 'Birthday', 'name' => config('constants.speaker.birthday'), 'placeholder' => 'yyyy-mm-dd', ])
        @include('components.inputs.text',[ 'label' => 'Social linking', 'name' => config('constants.speaker.social_linking'), 'placeholder' => 'Example: https://www.facebook.com/LocLe.isme', ])
        @include('components.inputs.text',[ 'label' => 'Avatar', 'name' => config('constants.speaker.avatar'), 'type' => 'file', 'class' => 'form-control-file', ])
        @include('components.inputs.textarea',[ 'label' => 'Description', 'name' => config('constants.speaker.description'), 'colLeft' => 12, 'placeholder' => 'Write something about you . . .' ])
        <hr class="mb-4">
        <button class="btn btn-primary" type="submit">Save session</button>
        <a href="events/detail.html" class="btn btn-link">Cancel</a>
    </form>
@endsection
