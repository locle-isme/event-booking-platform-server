@extends('layouts.app')
@section('content')
<!--
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>#</th>
                <th>Avatar</th>
                <th>Full name</th>
                <th>Email</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>1</td>
                <td><img class="img-thumbnail" style="width: 32px; height: 32px;"
                         src="https://i.pinimg.com/564x/c4/bf/4b/c4bf4bfd2f6bd6bdb4c47dbcb2cdbe9c.jpg" alt=""></td>
                <td>Something</td>
                <td>john@example.com</td>
                <td>
                    <a style="text-decoration: none;" href=""><button class="btn btn-sm btn-primary">Edit</button></a>
                    <a style="text-decoration: none;" href=""><button class="btn btn-sm btn-danger">Remove</button></a>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
    -->

    <div class="row">
        @foreach($speakers as $speaker)
            <div class="col-sm-12 col-md-3">
                <div class="card">
                    <img class="card-img-top" src="{{$speaker->avatar}}" alt="Card image" style="width: 100%; height: auto">
                    <div class="card-body">
                        <h4 class="card-title">{{$speaker->name}}</h4>
                        <p class="card-text">Birthday: {{$speaker->birthday}}</p>
                        <p class="card-text">{{$speaker->description}}</p>
                        <a href="{{route('speakers.edit', $speaker)}}" class="btn btn-primary">Edit</a>
                        <a href="#" class="btn btn-danger">Remove</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
