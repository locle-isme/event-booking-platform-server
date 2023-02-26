@extends('admin.layouts.app')
@section('content')
    <div class="row justify-content-center" style="padding-top: 89px;">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header"><h1 class="h4">CREATE NEW ORGANIZE</h1></div>
                <div class="card-body">
                    <form class="needs-validation" novalidate action="{{route('admin.organizer.store')}}" method="POST">
                        @csrf
                        @include('components.inputs.text', [
                            'label' => 'Company Name',
                            'name' => 'name',
                            'rowClass' => 'justify-content-center',
                            'colLeft' => 6,
                        ])
                        @include('components.inputs.text',[
                            'label' => 'Email',
                            'name' => 'email',
                            'type' => 'email',
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
