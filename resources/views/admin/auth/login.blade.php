@extends('admin.layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <main class="col-md-6 mx-sm-auto px-4">
                <div class="pt-3 pb-2 mb-3 border-bottom text-center">
                    <h1 class="h2">Admin Manager</h1>
                </div>
                @if(!empty($errors) && ($errors->has('username') || $errors->has('password')))
                <div class="text-center">
                    <div class="alert alert-danger">
                        Username or password not correct
                    </div>
                </div>
                @endif
                <form class="form-signin" action="{{route('admin.login')}}" method="POST">
                    @csrf
                    <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
                    <label for="inputUsername" class="sr-only">Username</label>
                    <input type="text" id="inputUsername" name="username" class="form-control" placeholder="" autofocus>

                    <label for="inputPassword" class="sr-only">Password</label>
                    <input type="password" id="inputPassword" name="password" class="form-control"
                           placeholder="">
                    <button class="btn btn-lg btn-primary btn-block" id="login" type="submit">Sign in</button>
                </form>

            </main>
        </div>
    </div>
@endsection
