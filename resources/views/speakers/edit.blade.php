@extends('layouts.app')
@section('content')
    <div class="mb-3 pt-3 pb-2">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center">
            <h2 class="h4">Edit speaker</h2>
        </div>
    </div>

    <form class="needs-validation" enctype="multipart/form-data" novalidate
          action="{{route('speakers.update', $speaker)}}" method="POST">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-8">
                @include('components.inputs.text', [
                            'label' => 'Name',
                            'name' => 'name',
                            'value' => $speaker->getAttribute('name'),
                        ])
                @include('components.inputs.text', [
                    'label' => 'Birthday',
                    'name' => 'birthday',
                    'placeholder' => 'yyyy-mm-dd',
                    'value' => $speaker->getAttribute('birthday'),
                ])
                @include('components.inputs.text', [
                    'label' => 'Social linking',
                    'name' => 'social_linking',
                    'placeholder' => 'Example: https://www.facebook.com/LocLe.isme',
                    'value' => $speaker->getAttribute('social_linking'),
                ])
                @include('components.inputs.text', [
                    'label' => 'Avatar',
                    'name' => 'avatar',
                    'type' => 'file',
                    'class' => 'form-control-file',
                ])
                @include('components.inputs.textarea', [
                    'label' => 'Description',
                    'name' => 'description',
                    'colLeft' => 12,
                    'placeholder' => 'Write something...',
                    'value' => $speaker->getAttribute('description'),
                ])
            </div>
            <div class="col-4 d-flex flex-column align-items-center">
                <img class="card-img-top on-form" src="{{ asset($speaker->getAttribute('avatar')) }}"
                     alt="Card image">
                @if(config('constants.common.default_avatar_image') != $speaker->getAttribute('avatar'))
                    <a href="{{route('speaker.remove_avatar', $speaker)}}" class="btn btn-danger btn-sm w-50 my-2">Remove
                        Avatar</a>
                @endif
            </div>
        </div>
        <hr class="mb-4">
        <button class="btn btn-primary" type="submit">Save</button>
        <a href="#" class="btn btn-link">Cancel</a>
    </form>
@endsection
