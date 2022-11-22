<x-skeleton>
    <x-slot:title>
        Profil
    </x-slot:title>
    <x-card>
        <div class="mb-3 row">
            <label for="name" class="col-sm-2 col-form-label">Jméno</label>
            <div class="col-sm-10">
                <input id="name" class="form-control" type="text" value="{{ Auth::user()->name }}" @disabled(!Route::is('profile-edit')) @readonly(!Route::is('profile-edit'))>
            </div>
        </div>
        <div class="mb-3 row">
            <label for="surname" class="col-sm-2 col-form-label">Příjmení</label>
            <div class="col-sm-10">
                <input id="surname" class="form-control" type="text" value="{{ Auth::user()->surname }}"  @disabled(!Route::is('profile-edit')) @readonly(!Route::is('profile-edit'))>
            </div>
        </div>
        <div class="mb-3 row">
            <label for="birth-date" class="col-sm-2 col-form-label">Datum narození</label>
            <div class="col-sm-10">
                <input id="birth-date" class="form-control" type="text" value="{{ Auth::user()->birth_date }}" @disabled(!Route::is('profile-edit')) @readonly(!Route::is('profile-edit'))>
            </div>
        </div>
        <div class="mb-3 row">
            <label for="phone-number" class="col-sm-2 col-form-label">Tel. číslo</label>
            <div class="col-sm-10">
                <input id="phone-number" class="form-control" type="text" value="{{ Auth::user()->phone_number }}" @disabled(!Route::is('profile-edit')) @readonly(!Route::is('profile-edit'))>
            </div>
        </div>
        <div class="mb-3 row">
            <label for="email" class="col-sm-2 col-form-label">Email</label>
            <div class="col-sm-10">
                <input id="email" class="form-control" type="text" value="{{ Auth::user()->email }}" @disabled(!Route::is('profile-edit')) @readonly(!Route::is('profile-edit'))>
            </div>
        </div>
        <div class="d-grid gap-2 col-6 mx-auto">
            @if(Route::is('profile'))
                <a href="{{ route('profile-edit') }}" class="btn btn-primary">Upravit</a>
            @elseif(Route::is('profile-edit'))
                <a href="{{ route('profile') }}" class="btn btn-primary">Uložit</a>
            @endif
        </div>
    </x-card>
</x-skeleton>
