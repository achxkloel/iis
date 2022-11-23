<x-skeleton>
    <x-slot:title>
        Nový uživatel
    </x-slot:title>
    <x-card>
        <form action="{{ route('admin-create-person') }}" method="post">
            @csrf

            @error('alert')
                <div class="alert alert-danger" role="alert">
                    {{ $message }}
                </div>
            @enderror

            @error('success')
                <div class="alert alert-success" role="alert">
                    {{ $message }}
                </div>
            @enderror

            <div class="mb-3 row">
                <label for="login" class="col-sm-2 col-form-label required-label">Login</label>
                <div class="col-sm-10">
                    <div class="input-group">
                        <input type="text" class="form-control @error('login') is-invalid @enderror" id="login" name="login" value="{{ old('login') }}" aria-describedby="loginError">
                        <a href="#" class="btn btn-outline-secondary">Zkontrolovat</a>
                    </div>
                    @error('login')
                        <div id="loginError" class="invalid-feedback text-start">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="mb-3 row">
                <label for="name" class="col-sm-2 col-form-label required-label">Jméno</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" aria-describedby="nameError">
                    @error('name')
                        <div id="nameError" class="invalid-feedback text-start">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="mb-3 row">
                <label for="surname" class="col-sm-2 col-form-label required-label">Příjmení</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control @error('surname') is-invalid @enderror" id="surname" name="surname" value="{{ old('surname') }}" aria-describedby="surnameError">
                    @error('login')
                        <div id="surnameError" class="invalid-feedback text-start">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="mb-3 row">
                <label for="role" class="col-sm-2 col-form-label required-label">Role</label>
                <div class="col-sm-10">
                    <select class="form-select @error('role') is-invalid  @enderror" id="role" name="role" aria-describedby="roleError" >
                        <option value="student" selected>Student</option>
                        <option value="teacher">Učitel</option>
                        <option value="guarantor">Garant</option>
                    </select>
                    @error('role')
                        <div id="roleError" class="invalid-feedback text-start">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <!-- Submit button -->
            <button type="submit" class="btn btn-primary">Vytvořit</button>
        </form>
    </x-card>
</x-skeleton>