<x-skeleton>
    <div class="activation-card-container">
        <div class="activation-card">
            <div class="card text-center">
                <h5 class="card-header">
                    Aktivace účtu
                </h5>
                <form action="{{ route('activate') }}" method="post">
                    @csrf

                    @error('login_not_found')
                        <div class="alert alert-danger text-start" role="alert">
                            Nenalezen žadný uživatel s loginem <span class="fw-bold">{{ old('login') }}</span>
                        </div>
                    @enderror

                    @error('alert')
                        <div class="alert alert-danger" role="alert">
                            {{ $message }}
                        </div>
                    @enderror

                    <!-- Email-->
                    <div class="row mb-3">
                        <label for="login" class="col-sm-4 col-form-label required-label">Login</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control @error('login') is-invalid @enderror" id="login" name="login" value="{{ old('login') }}" aria-describedby="loginError">
                            @error('login')
                                <div id="loginError" class="invalid-feedback text-start">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="tempPassword" class="col-sm-4 col-form-label required-label">Dočasné heslo</label>
                        <div class="col-sm-8">
                            <input type="password" class="form-control @error('tempPassword') is-invalid  @enderror" id="tempPassword" name="tempPassword" aria-describedby="tempPasswordError">
                            @error('tempPassword')
                                <div id="tempPasswordError" class="invalid-feedback text-start">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="newPassword" class="col-sm-4 col-form-label required-label">Nové heslo</label>
                        <div class="col-sm-8">
                            <input type="password" class="form-control @error('newPassword') is-invalid  @enderror" id="newPassword" name="newPassword" aria-describedby="newPasswordError">
                            @error('newPassword')
                                <div id="newPasswordError" class="invalid-feedback text-start">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="newPasswordCheck" class="col-sm-4 col-form-label required-label">Kontrola hesla</label>
                        <div class="col-sm-8">
                            <input type="password" class="form-control @error('newPasswordCheck') is-invalid  @enderror" id="newPasswordCheck" name="newPasswordCheck" aria-describedby="newPasswordCheckError">
                            @error('newPasswordCheck')
                                <div id="newPasswordCheckError" class="invalid-feedback text-start">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <!-- Submit button -->
                    <button type="submit" class="btn btn-primary">Aktivovat</button>
                </form>
            </div>
        </div>
    </div>
</x-skeleton>
