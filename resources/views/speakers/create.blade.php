@extends('layouts.app')
@section('content')
    <div class="mb-3 pt-3 pb-2">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center">
            <h2 class="h4">Create new session</h2>
        </div>
    </div>

    <form class="needs-validation" novalidate action="{{route('speakers.store')}}" method="post">
        @csrf

<div class="row">
    <div class="col-sm-12 col-md-6">
        <div class="row">
            <div class="col-12 col-lg-8 mb-3">
                <label for="inputName">Name</label>
                <!-- adding the class is-invalid to the input, shows the invalid feedback below -->
                <input type="text" class="form-control @if($errors->has('name')) is-invalid @endif" id="inputName"
                       name="name" placeholder="" value="{{old('name')}}">
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{$errors->first('name')}}
                    </div>
                @endif
            </div>
        </div>

        <div class="row">
            <div class="col-12 col-lg-8 mb-3">
                <label for="inputBirthday">Birthday</label>
                <input type="text"
                       class="form-control @if($errors->has('birthday')) is-invalid @endif"
                       id="inputBirthday"
                       name="birthday"
                       placeholder="yyyy-mm-dd"
                       value="{{old('birthday') }}">
                @if($errors->has('birthday'))
                    <div class="invalid-feedback">
                        {{$errors->first('birthday')}}
                    </div>
                @endif
            </div>
        </div>

        <div class="row">
            <div class="col-12 col-lg-8 mb-3">
                <label for="inputSocialLinking">Social linking</label>
                <!-- adding the class is-invalid to the input, shows the invalid feedback below -->
                <input type="text" class="form-control @if($errors->has('social_linking')) is-invalid @endif"
                       id="inputSocialLinking"
                       name="social_linking" placeholder="Example: https://www.facebook.com/LocLe.isme" value="{{old('social_linking')}}" >
                @if($errors->has('social_linking'))
                    <div class="invalid-feedback">
                        {{$errors->first('social_linking')}}
                    </div>
                @endif
            </div>
        </div>

        <div class="row">
            <div class="col-12 col-lg-8 mb-3">
                <label for="inputAvatar">Avatar</label>
                <!-- adding the class is-invalid to the input, shows the invalid feedback below -->
                <input type="file" class="form-control-file @if($errors->has('social_linking')) is-invalid @endif" id="inputAvatar" name="avatar">
                @if($errors->has('avatar'))
                    <div class="invalid-feedback">
                        {{$errors->first('avatar')}}
                    </div>
                @endif
            </div>
        </div>
    </div>
    <div class="d-sm-block col-md-6"></div>
</div>

        <div class="row">
            <div class="col-12 mb-3">
                <label for="textareaDescription">Description</label>
                <textarea class="form-control @if($errors->has('description')) is-invalid @endif"
                          id="textareaDescription" name="description" placeholder=""
                          rows="5">{{old('description')}}</textarea>
                @if($errors->has('description'))
                    <div class="invalid-feedback">
                        {{$errors->first('description')}}
                    </div>
                @endif
            </div>
        </div>

        <hr class="mb-4">
        <button class="btn btn-primary" type="submit">Save session</button>
        <a href="events/detail.html" class="btn btn-link">Cancel</a>
    </form>
@endsection
