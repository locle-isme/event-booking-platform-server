@extends('layouts.app')
@section('content')

    <form class="needs-validation" novalidate action="{{route('events.update', $event)}}" method="post">
        @method('put')
        @csrf
        <div class="row">
            <div class="col-12 col-lg-4 mb-3">
                <label for="inputName">Name</label>
                <!-- adding the class is-invalid to the input, shows the invalid feedback below -->
                <input type="text" class="form-control @if($errors->has('name')) is-invalid @endif" id="inputName"
                       name="name" placeholder="" value="{{old('name') ?? $event->name}}">
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{$errors->first('name')}}
                    </div>
                @endif
            </div>
        </div>

        <div class="row">
            <div class="col-12 col-lg-4 mb-3">
                <label for="inputSlug">Slug</label>
                <input type="text" class="form-control @if($errors->has('slug')) is-invalid @endif" id="inputSlug" name="slug" placeholder="" value="{{old('slug') ?? $event->slug}}">
                @if($errors->has('slug'))
                    <div class="invalid-feedback">
                        {{$errors->first('slug')}}
                    </div>
                @endif
            </div>
        </div>

        <div class="row">
            <div class="col-12 col-lg-4 mb-3">
                <label for="inputDate">Date</label>
                <input type="text"
                       class="form-control @if($errors->has('date')) is-invalid @endif"
                       id="inputDate"
                       name="date"
                       placeholder="yyyy-mm-dd"
                       value="{{old('date') ?? $event->date}}">
                @if($errors->has('date'))
                    <div class="invalid-feedback">
                        {{$errors->first('date')}}
                    </div>
                @endif
            </div>
        </div>

        <hr class="mb-4">
        <button class="btn btn-primary" type="submit">Save event</button>
        <a href="events/index.html" class="btn btn-link">Cancel</a>
    </form>
@endsection
