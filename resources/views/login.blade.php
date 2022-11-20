<h1>Login</h1>

@if ($errors->has('login'))
    <p>
        <strong>{{ $errors->first('login') }}</strong>
    </p>
@endif

<form  action="{{ route('login') }}"  method="post">
    @csrf

    <!-- Email-->
    <label for="login">Login</label>
    <input type="login" name="login" id="login" value="{{ old('login') }}" />

    <!-- Password -->
    <label for="password">Password</label>
    <input type="password" name="password" id="password" />

    <!-- Submit button -->
    <button type="submit">Login</button>
</form>
