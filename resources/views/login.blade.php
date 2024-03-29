<x-skeleton>
    <div class="login-card-container">
        <div class="login-card">
            <div class="card text-center">
                <h5 class="card-header">
                    Přihlásit se
                </h5>
                <form action="{{ route('login') }}" method="post">
                    @csrf

                    @if (Session::has('activated'))
                        <div class="alert alert-success" role="alert">
                            {{ Session::get('activated') }}
                        </div>
                    @endif

                    @error('alert')
                        <div class="alert alert-danger" role="alert">
                            {{ $message }}
                        </div>
                    @enderror

                    <!-- Email-->
                    <div class="row mb-3">
                        <label for="login" class="col-sm-2 col-form-label required-label">Login</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control @error('login') is-invalid @enderror" id="login" name="login" value="{{ old('login') }}" aria-describedby="loginError">
                            @error('login')
                                <div id="loginError" class="invalid-feedback text-start">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="password" class="col-sm-2 col-form-label required-label">Heslo</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control @error('password') is-invalid  @enderror" id="password" name="password" aria-describedby="passwordError">
                            @error('password')
                                <div id="passwordError" class="invalid-feedback text-start">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <!-- Submit button -->
                    <button type="submit" class="btn btn-primary">Přihlásit</button>
                </form>
            </div>
        </div>
    </div>
</x-skeleton>
