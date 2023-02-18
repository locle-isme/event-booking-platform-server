@extends('layouts.app')
@section('content')
    <div class="row">
        @foreach($speakers as $speaker)
            <div class="col-sm-12 col-md-3">
                <div class="card">
                    <img class="card-img-top" src="{{$speaker->getAttribute('avatar')}}" alt="Card image"
                         style="width: 100%; height: auto">
                    <div class="card-body">
                        <h4 class="card-title">{{$speaker->getAttribute('name')}}</h4>
                        <p class="card-text">Birthday: {{$speaker->getAttribute('birthday')}}</p>
                        <p class="card-text description"
                           style="max-height: 105px;">{{$speaker->getAttribute('description')}}</p>
                        <a href="{{route('speakers.edit', $speaker)}}" class="btn btn-sm btn-primary">Edit</a>
                        <a href="#" class="btn btn-sm btn-danger"
                           onclick="event.preventDefault();document.getElementById('removeSpeakerForm{{$speaker->getAttribute('id')}}').submit()">Remove</a>
                        <form action="{{route('speakers.destroy', $speaker)}}"
                              id="removeSpeakerForm{{$speaker->getAttribute('id')}}" method="post"> @csrf @method('delete')
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
