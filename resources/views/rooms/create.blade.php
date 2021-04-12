@extends('layouts.app')
@section('content')

    <div class="mb-3 pt-3 pb-2">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center">
            <h2 class="h4">Create new room</h2>
        </div>
    </div>

    <form class="needs-validation" novalidate action="{{route('rooms.store', $event)}}" method="post">
        @csrf
        <div class="row">
            <div class="col-12 col-lg-4 mb-3">
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
            <div class="col-12 col-lg-4 mb-3">
                <label for="selectChannel">Channel</label>
                <select class="form-control @if($errors->has('channel')) is-invalid @endif" id="selectChannel"
                        name="channel">
                    @foreach($event->channels as $channel)
                        <option value="{{$channel->id}}" @if(old('channel') == $channel->id) selected @endif>{{$channel->name}}</option>
                    @endforeach
                </select>
                @if($errors->has('channel'))
                    <div class="invalid-feedback">
                        {{$errors->first('channel')}}
                    </div>
                @endif
            </div>
        </div>

        <div class="row">
            <div class="col-12 col-lg-4 mb-3">
                <label for="inputCapacity">Capacity</label>
                <input type="number" class="form-control @if($errors->has('capacity')) is-invalid @endif"
                       id="inputCapacity"
                       name="capacity" placeholder="" value="{{old('capacity')}}">
                @if($errors->has('capacity'))
                    <div class="invalid-feedback">
                        {{$errors->first('capacity')}}
                    </div>
                @endif
            </div>
        </div>

        <hr class="mb-4">
        <button class="btn btn-primary" type="submit">Save room</button>
        <a href="events/detail.html" class="btn btn-link">Cancel</a>
    </form>


@endsection
