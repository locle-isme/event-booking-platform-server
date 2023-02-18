@extends('layouts.app')
@section('content')
    <div class="mb-3 pt-3 pb-2">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center">
            <h2 class="h4">Create new speaker</h2>
        </div>
    </div>

    <form class="needs-validation" enctype="multipart/form-data" novalidate action="{{route('speakers.store')}}"
          method="POST">
        @csrf
        <div class="row">
            <div class="col-8">
                @include('components.inputs.text', [
                            'label' => 'Name',
                            'name' => 'name',
                        ])
                @include('components.inputs.text', [
                    'label' => 'Birthday',
                    'name' => 'birthday',
                    'placeholder' => 'yyyy-mm-dd',
                ])
                @include('components.inputs.text', [
                    'label' => 'Social linking',
                    'name' => 'social_linking',
                    'placeholder' => 'Example: https://www.facebook.com/LocLe.isme',
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
                ])
            </div>
            <div class="col-4">
                <img class="card-img-top on-form" src="{{ asset(config('constants.common.default_avatar_image')) }}"
                     alt="Card image">
            </div>
        </div>
        <hr class="mb-4">
        <button class="btn btn-primary" type="submit">Save</button>
        <a href="#" class="btn btn-link">Cancel</a>
    </form>
@endsection
