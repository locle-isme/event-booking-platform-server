<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Event Booking Platform') }}</title>
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ=" crossorigin="anonymous"></script>
</head>
<body>
@if(Auth::guard('admin')->check())
    @include('admin.layouts.nav')
    <div class="container-fluid">
        <div class="row">
            <main role="main" class="col-md-12 ml-sm-auto col-lg-12 px-4">
                @isset($event)
                    <div class="border-bottom mb-3 pt-3 pb-2 event-title">
                        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center">
                            <h1 class="h2">{{$event->name}}</h1>
                            @if(Route::currentRouteName() == 'events.show')
                                <div class="btn-toolbar mb-2 mb-md-0">
                                    <div class="btn-group mr-2">
                                        <a href="{{route('events.edit', $event)}}"
                                           class="btn btn-sm btn-outline-secondary">Edit event</a>
                                    </div>
                                </div>
                            @endif
                        </div>
                        @if(Route::currentRouteName() != 'events.edit')
                            <span class="h6">{{date('F j, Y', strtotime($event->date))}}</span>
                        @endif
                    </div>
                @endisset

                @if(Route::currentRouteName() == 'speakers.index')
                    <div
                        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                        <h1 class="h2">Manage Speakers</h1>
                        <div class="btn-toolbar mb-2 mb-md-0">
                            <div class="btn-group mr-2">
                                <a href="{{route('speakers.create')}}" class="btn btn-sm btn-outline-secondary">Create
                                    new speaker</a>
                            </div>
                        </div>
                    </div>
                @endif

                @if(session('message'))
                    <div class="mb-3 pt-2">
                        <div class="alert alert-success">
                            {{session('message')}}
                        </div>
                    </div>
                @endif

                @if(session('error-message'))
                    <div class="mb-3 pt-2">
                        <div class="alert alert-danger">
                            {{session('error-message')}}
                        </div>
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>
    <script>
        let cancelBtns = document.querySelectorAll('.btn.btn-link');
        cancelBtns.forEach(btn => {
            btn.onclick = function () {
                event.preventDefault();
                window.history.back();
            }
        })
    </script>
@else
    @yield('content')
@endif
@stack('js')
</body>
</html>
