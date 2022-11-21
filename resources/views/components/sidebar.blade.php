<div class="sidenav">
    {{-- TODO: opravneni --}}
    <a href="#"><img src="{{ URL::asset('img/logo.png') }}" alt=""></a>
    @if(!Route::is('login'))
        <a href="{{ route('login') }}">Přihlásit se</a>
    @endif
    <a href="#">Profil</a>
    <a href="#">Přehled studia</a>
    <a href="#">Mé kurzy</a>
</div>
