<div class="sidebar-sticky">
    <ul class="nav flex-column">
        <li class="nav-item"><a class="nav-link @if(Route::currentRouteName() == 'events.index') active @endif"
                                href="{{route('events.index')}}">Manage Events</a></li>
    </ul>
    @isset($event)
        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
            <span>{{$event->name}}</span>
        </h6>
        <ul class="nav flex-column">
            <li class="nav-item"><a class="nav-link @if(Route::currentRouteName() == 'events.show') active @endif"
                                    href="{{route('events.show', $event)}}">Overview</a></li>
        </ul>

        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
            <span>Reports</span>
        </h6>
        <ul class="nav flex-column mb-2">
            <li class="nav-item"><a class="nav-link" href="reports/index.html">Room capacity</a></li>
        </ul>
    @endif
</div>

