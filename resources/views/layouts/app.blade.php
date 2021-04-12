<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Event Booking Platform') }}</title>

    <!-- Scripts -->
{{--    <script src="{{ asset('js/app.js') }}" defer></script>--}}

<!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
</head>
<body>
@guest()
    @yield('content')
@else
    @include('layouts.nav')
    <div class="container-fluid">
        <div class="row">
            <nav class="col-md-2 d-none d-md-block bg-light sidebar">
                @include('layouts.sidebar')
            </nav>
            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
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

                @if(session('message'))
                    <div class="mb-3 pt-2">
                        <div class="alert alert-success">
                            {{session('message')}}
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
@endguest
</body>
</html>
