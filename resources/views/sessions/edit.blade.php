@extends('layouts.app')
@section('content')
    <div class="mb-3 pt-3 pb-2">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center">
            <h2 class="h4">Edit session</h2>
        </div>
    </div>

    <form class="needs-validation" novalidate
          action="{{route('sessions.update', ['event' => $event, 'session' => $session])}}" method="post">
        @csrf
        @method('put')
        <div class="row">
            <div class="col-12 col-lg-4 mb-3">
                <label for="selectType">Type</label>
                <select class="form-control" id="selectType" name="type">
                    <option value="talk" @if(old('type') == 'talk' || $session->type == 'talk') selected @endif>Talk
                    </option>
                    <option value="workshop"
                            @if(old('type') == 'workshop' || $session->type == 'workshop') selected @endif>Workshop
                    </option>
                </select>
            </div>
        </div>


        <div class="row">
            <div class="col-12 col-lg-4 mb-3">
                <label for="inputTitle">Title</label>
                <!-- adding the class is-invalid to the input, shows the invalid feedback below -->
                <input type="text" class="form-control @if($errors->has('title')) is-invalid @endif" id="inputTitle"
                       name="title" placeholder="" value="{{old('title') ?? $session->title}}">
                @if($errors->has('title'))
                    <div class="invalid-feedback">
                        {{$errors->first('title')}}
                    </div>
                @endif
            </div>
        </div>

        <div class="row">
            <div class="col-12 col-lg-4 mb-3">
                <label for="inputSpeakers">Speakers</label>
                <!-- adding the class is-invalid to the input, shows the invalid feedback below -->
                <select id="inputSpeakers" name="speakers[]"
                        class="form-control @if($errors->has('speakers')) is-invalid @endif" multiple>
                    @foreach($speakers as $speaker)
                        <option value="{{$speaker->id}}"
                                @if(in_array($speaker->id, $session->sessionSpeakers)) selected @endif>{{$speaker->name}}</option>
                    @endforeach
                </select>
                @if($errors->has('speakers'))
                    <div class="invalid-feedback">
                        {{$errors->first('speakers')}}
                    </div>
                @endif
            </div>
        </div>

        <div class="row">
            <div class="col-12 col-lg-4 mb-3">
                <label for="selectRoom">Room</label>
                <select class="form-control @if($errors->has('room')) is-invalid @endif" id="selectRoom" name="room">
                    @foreach($event->rooms as $room)
                        <option value="{{$room->id}}"
                                @if(old('room') == $room->id) selected @endif>{{$room->name.'/'.$room->channel->name}}</option>
                    @endforeach
                </select>
                @if($errors->has('room'))
                    <div class="invalid-feedback">
                        {{$errors->first('room')}}
                    </div>
                @endif
            </div>
        </div>

        <div class="row">
            <div class="col-12 col-lg-4 mb-3">
                <label for="inputCost">Cost</label>
                <!-- adding the class is-invalid to the input, shows the invalid feedback below -->
                <input type="number" class="form-control @if($errors->has('cost')) is-invalid @endif" id="inputCost"
                       name="cost" placeholder="" value="{{old('cost') ?? $session->cost}}">
                @if($errors->has('cost'))
                    <div class="invalid-feedback">
                        {{$errors->first('cost')}}
                    </div>
                @endif
            </div>
        </div>

        <div class="row">
            <div class="col-12 col-lg-6 mb-3">
                <label for="inputStart">Start</label>
                <input type="text"
                       class="form-control @if($errors->has('start')) is-invalid @endif"
                       id="inputStart"
                       name="start"
                       placeholder="yyyy-mm-dd HH:MM"
                       value="{{old('start') ?? $session->start }}">
                @if($errors->has('start'))
                    <div class="invalid-feedback">
                        {{$errors->first('start')}}
                    </div>
                @endif
            </div>
            <div class="col-12 col-lg-6 mb-3">
                <label for="inputEnd">End</label>
                <input type="text"
                       class="form-control @if($errors->has('end')) is-invalid @endif"
                       id="inputEnd"
                       name="end"
                       placeholder="yyyy-mm-dd HH:MM"
                       value="{{old('end') ?? $session->end }}">
                @if($errors->has('end'))
                    <div class="invalid-feedback">
                        {{$errors->first('end')}}
                    </div>
                @endif
            </div>
        </div>

        <div class="row">
            <div class="col-12 mb-3">
                <label for="textareaDescription">Description</label>
                <textarea class="form-control @if($errors->has('description')) is-invalid @endif"
                          id="textareaDescription" name="description" placeholder=""
                          rows="5">{{old('description') ?? $session->description }}</textarea>
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
