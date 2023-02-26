@extends('admin.layouts.app')
@section('content')
    <div
        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Organizer management</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group mr-2">
                <a href="{{route('admin.organizer.create')}}" class="btn btn-sm btn-outline-secondary">Create new organizer</a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="table-responsive sessions">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Email</th>
                    <th>Name</th>
                    <th>Slug</th>
                    <th>Active</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($organizers as $organizer)
                    <tr>
                        <td class="text-nowrap">{{$organizer['id']}}</td>
                        <td class="text-nowrap">{{$organizer['email']}}</td>
                        <td class="text-nowrap">{{$organizer['name']}}</td>
                        <td class="text-nowrap">{{$organizer['slug']}}</td>
                        <td class="text-nowrap">
                            @include('components.inputs.switch', [
                                'label' => 'Active',
                                'name' => 'active',
                                'value' => $organizer['active'],
                            ])
                        </td>
                        <td class="text-capitalize">
                            <div class="btn-group">
                                <a href="{{route('admin.organizer.force_login', $organizer)}}"
                                   class="btn btn-sm btn-primary">Login</a>
                                <a href="{{route('admin.organizer.edit', $organizer)}}"
                                   class="btn btn-sm btn-warning">Edit</a>
                                <button class="btn btn-sm btn-outline-danger">Remove</button>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{$organizers->links()}}
        </div>
    </div>
@endsection

