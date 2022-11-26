<div class="sidenav">
    {{-- TODO: opravneni --}}
    <a href="{{ route('homepage') }}"><img src="{{ URL::asset('img/logo.png') }}" alt=""></a>
    @unless(Route::is('login') || Auth::check())
        <a href="{{ route('login') }}">Přihlásit se</a>
    @endunless
    @if(Auth::check())
        <a href="{{ route('logout') }}">Odhlásit se</a>
    @endif
    @if(Auth::check())
        <a href="{{ route('profile') }}">Profil</a>
    @endif
    @if(Auth::check() && (Auth::user()->role == 'student' || Auth::user()->role == 'admin'))
        <a href="{{ route('studies-overview') }}">Přehled studia</a>
    @endif
    @if(Auth::check() && (Auth::user()->role == 'teacher' || Auth::user()->role == 'admin'))
        <a href="{{ route('my-courses') }}">Mé kurzy</a>
    @endif

    {{-- Admin --}}
    @if (Auth::check() && (Auth::user()->role == 'admin'))
        <a href="{{ route('admin-persons') }}">Uživatelé</a>
        <a href="{{ route('admin-classes') }}">Místnosti</a>
    @endif
</div>
