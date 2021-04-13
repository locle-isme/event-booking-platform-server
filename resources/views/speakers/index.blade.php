@extends('layouts.app')
@section('content')
    <div
        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Manage Speakers</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group mr-2">
                <a href="{{route('speakers.create')}}" class="btn btn-sm btn-outline-secondary">Create new speaker</a>
            </div>
        </div>
    </div>
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
        <div class="col-sm-12 col-md-3">
            <div class="card">
                <img class="card-img-top" src="https://scr.vn/wp-content/uploads/2020/07/Avt-Anime-c%C3%B4-g%C3%A1i-cute-1024x1024.jpg" alt="Card image" style="width: 100%; height: auto">
                <div class="card-body">
                    <h4 class="card-title">John Doe</h4>
                    <p class="card-text">Some example text some example text. John Doe is an architect and engineer</p>
                    <a href="#" class="btn btn-primary">Edit</a>
                    <a href="#" class="btn btn-danger">Remove</a>
                </div>
            </div>
        </div>
    </div>
@endsection
