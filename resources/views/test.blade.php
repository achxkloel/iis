<x-greeter>
    <x-slot:name>
        {{ $name }}
    </x-slot:name>
    <div class="mb-3">
        <label for="age" class="form-label">Enter your age:</label>
        <input type="number" class="form-control" id="age" placeholder="Your age">
    </div>
    
    @if (Auth::check())
        <form action="{{ route('logout') }}" method="get">
            @csrf

            <button type="submit">Logout</button>
        </form>
    @else
        <form action="{{ route('login') }}" method="get">
            @csrf

            <button type="submit">Login</button>
        </form>
    @endif
</x-greeter>