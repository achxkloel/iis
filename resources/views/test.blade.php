<x-greeter>
    <x-slot:name>
        {{ $name }}
    </x-slot:name>
    <div class="mb-3">
        <label for="age" class="form-label">Enter your age:</label>
        <input type="number" class="form-control" id="age" placeholder="Your age">
    </div>
</x-greeter>
