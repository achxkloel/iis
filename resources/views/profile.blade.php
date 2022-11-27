<x-skeleton>
    <x-slot:title>
        Profil
    </x-slot:title>
    <x-card>
        <x-slot:title>
            Osobní údaje
        </x-slot:title>
        <form action="{{ route('profile') }}" method="post">
            @csrf

            <div class="mb-3 row">
                <label for="login" class="col-sm-2 col-form-label">Login</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="login" value="{{ Auth::user()->login }}" disabled>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="name" class="col-sm-2 col-form-label">Jméno</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="name" value="{{ Auth::user()->name }}" disabled>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="surname" class="col-sm-2 col-form-label">Příjmení</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="surname" value="{{ Auth::user()->surname }}" disabled>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="birth_date" class="col-sm-2 col-form-label">Datum narození</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control @error('birth_date') is-invalid @enderror" id="birth_date" name="birth_date" value="{{ Auth::user()->birth_date?->format('d.m.Y') }}" aria-describedby="birthDateError">
                    @error('birth_date')
                        <div id="birthDateError" class="invalid-feedback text-start">
                            {{ $message }}
                        </div>
                    @enderror
                    <div class="form-text text-start">Příklad: {{ now()->isoFormat('DD.MM.YYYY') }}</div>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="address" class="col-sm-2 col-form-label">Adresa</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control @error('address') is-invalid @enderror" id="address" name="address" value="{{ Auth::user()->address }}" aria-describedby="addressError">
                    @error('address')
                        <div id="addressError" class="invalid-feedback text-start">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="mb-3 row">
                <label for="phone_number" class="col-sm-2 col-form-label">Telefon</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control @error('phone_number') is-invalid @enderror" id="phone_number" name="phone_number" value="{{ Auth::user()->phone_number }}" aria-describedby="phoneNumberError">
                    @error('phone_number')
                        <div id="phoneNumberError" class="invalid-feedback text-start">
                            {{ $message }}
                        </div>
                    @enderror
                    <div class="form-text text-start">Příklad: +420 123 456 789</div>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="email" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ Auth::user()->email }}" aria-describedby="emailError">
                    @error('email')
                        <div id="emailError" class="invalid-feedback text-start">
                            {{ $message }}
                        </div>
                    @enderror
                    <div class="form-text text-start">Příklad: jan_novak49@example.com</div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Změnit</button>
        </form>
    </x-card>
</x-skeleton>
