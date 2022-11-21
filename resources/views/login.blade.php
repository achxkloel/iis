<x-skeleton>
    @if ($errors->has('login'))
        <p>
            <strong>{{ $errors->first('login') }}</strong>
        </p>
    @endif
        <div class="login-card-container">
            <div class="login-card">
                <div class="card text-center">
                    <div class="card-header">
                        Přihlásit se
                    </div>
                    <form action="{{ route('login') }}" method="post">
                        @csrf

                        <!-- Email-->
                        <div class="row mb-3">
                            <label for="login" class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="login" name="login" value="{{ old('login') }}">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="password" class="col-sm-2 col-form-label">Heslo</label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control" id="password" name="password">
                            </div>
                        </div>

                        <!-- Submit button -->
                        <button type="submit" class="btn btn-primary">Přihlásit</button>
                    </form>
                </div>
            </div>
        </div>
</x-skeleton>
