<nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
    <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="{{route('admin.home')}}">Event Platform</a>
    <span class="navbar-organizer w-100">{{\Illuminate\Support\Facades\Auth::user()->name}}</span>
    <ul class="navbar-nav px-3">
        <li class="nav-item text-nowrap">
            <a class="nav-link" id="logout" href="#" onclick="event.preventDefault();document.getElementById('formLogout').submit()">Sign out</a>
        </li>
        <form id="formLogout" action="{{route('admin.logout')}}" method="post">@csrf</form>
    </ul>
</nav>
