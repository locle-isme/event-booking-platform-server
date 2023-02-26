@extends('admin.layouts.app')
@section('content')
    <div class="row justify-content-center" style="padding-top: 89px;">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header"><h1 class="h4">UPDATE ORGANIZE</h1></div>
                <div class="card-body">
                    <form class="needs-validation" novalidate action="{{route('admin.organizer.update', $organizer)}}"
                          method="POST">
                        @method('PUT')
                        @csrf
                        @include('components.inputs.text',[
                            'label' => 'Email',
                            'name' => 'email',
                            'type' => 'email',
                            'value' => $organizer->getAttribute('email'),
                            'disabled' => true,
                            'rowClass' => 'justify-content-center',
                            'colLeft' => 6,
                        ])
                        @include('components.inputs.text', [
                            'label' => 'Name',
                            'name' => 'name',
                            'value' => $organizer->getAttribute('name'),
                            'rowClass' => 'justify-content-center',
                            'colLeft' => 6,
                        ])
                        @include('components.inputs.text', [
                            'label' => 'Slug',
                            'name' => 'slug',
                            'value' => $organizer->getAttribute('slug'),
                            'rowClass' => 'justify-content-center',
                            'colLeft' => 6,
                        ])
                        @include('components.inputs.text', [
                            'label' => 'Password',
                            'name' => 'password',
                            'type' => 'password',
                            'rowClass' => 'justify-content-center',
                            'colLeft' => 6,
                        ])
                        @include('components.inputs.text', [
                            'label' => 'Password Confirm',
                            'name' => 'password_confirmation',
                            'type' => 'password',
                            'rowClass' => 'justify-content-center',
                            'colLeft' => 6,
                        ])
                        @include('components.inputs.switch', [
                            'label' => 'Active',
                            'name' => 'active',
                            'rowClass' => 'justify-content-center',
                            'value' => $organizer->getAttribute('active'),
                            'colLeft' => 6,
                        ])
                        <hr class="mb-4">
                        <div class="row justify-content-center">
                            <button class="btn btn-primary" type="submit">Save</button>
                            <a href="#" class="btn btn-link">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
