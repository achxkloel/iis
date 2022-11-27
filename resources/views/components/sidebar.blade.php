<div class="sidenav">
    <a href="{{ route('homepage') }}"><img src="{{ URL::asset('img/logo.png') }}" alt=""></a>
    <a href="{{ route('homepage') }}">Přehled kurzů</a>
    
    @guest
        <a href="{{ route('login') }}">Přihlásit se</a>
        <a href="{{ route('activate') }}">Aktivace účtu</a>
    @endguest

    @auth
        <a href="{{ route('profile') }}">Profil</a>
        <a href="{{ route('studies-overview') }}">Přehled studia</a>
        <a href="{{ route('schedule')}}">Rozvrh</a>

        @if (Auth::user()->hasRole('teacher'))
            <a href="{{ route('my-courses') }}">Mé kurzy</a>
        @endif

        @if (Auth::user()->role == 'admin')
            <a href="{{ route('admin-persons') }}">Uživatelé</a>
            <a href="{{ route('admin-classes') }}">Místnosti</a>
        @endif

        <a href="{{ route('logout') }}">Odhlásit se</a>
    @endauth
</div>
