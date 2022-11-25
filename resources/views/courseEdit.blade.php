<x-skeleton>
    <x-slot:title>
        @if(Route::is('course-create'))
            Vytvořit kurz
        @else
            Upravit kurz
        @endif
    </x-slot:title>
    <x-card>
        <x-slot:title>
            Základní info
        </x-slot:title>
        <form action="{{ Route::is('course-create') ? route('course-create') : route('course-edit', $course->id) }}" method="post">
            @csrf
            <div class="mb-3 row">
                <label for="name" class="col-sm-2 col-form-label required-label">Název</label>
                <div class="col-sm-10">
                    <input id="name" name="name" class="form-control @error('name') is-invalid @enderror" type="text" value="{{ $course->name }}">
                    @error('name')
                        <div id="nameError" class="invalid-feedback text-start">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="mb-3 row">
                <label for="shortcut" class="col-sm-2 col-form-label required-label">Zkratka</label>
                <div class="col-sm-10">
                    <input id="shortcut" name="shortcut" class="form-control @error('shortcut') is-invalid @enderror" type="text" value="{{ $course->shortcut }}">
                    @error('shortcut')
                        <div id="nameError" class="invalid-feedback text-start">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="mb-3 row">
                <label for="description" class="col-sm-2 col-form-label required-label">Popis</label>
                <div class="col-sm-10">
                    <input id="description" name="description" class="form-control @error('description') is-invalid @enderror" type="text" value="{{ $course->description }}">
                    @error('description')
                        <div id="nameError" class="invalid-feedback text-start">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="mb-3 row">
                <label for="capacity" class="col-sm-2 col-form-label required-label">Limit</label>
                <div class="col-sm-10 number-input">
                    <input id="capacity" name="capacity" class="form-control @error('capacity') is-invalid @enderror" type="text" value="{{ $course->capacity }}">
                    @error('capacity')
                        <div id="nameError" class="invalid-feedback text-start">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="d-grid gap-2 col-6 mx-auto">
                <button type="submit" class="btn btn-primary">Uložit</button>
            </div>
        </form>
    </x-card>
    @if(Route::is('course-edit'))
        <x-card>
            <x-slot:title>
                Seznam termínů
            </x-slot:title>
            <table class="table align-middle">
                <thead>
                    <tr>
                        <th scope="col">Termín</th>
                        <th scope="col">Typ registrace</th>
                        <th scope="col">Čas</th>
                        <th scope="col">Místnost</th>
                        <th scope="col" class="small-button-column"></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Termín 1</td>
                        <td>automaticky</td>
                        <td>út 09-11</td>
                        <td>D105</td>
                        <td><x-go-trash-24 /></td> {{-- TODO: on click actions --}}
                    </tr>
                    <tr>
                        <td>Termín 2</td>
                        <td>ručně</td>
                        <td>st 12-14</td>
                        <td>E112</td>
                        <td><x-go-trash-24 /></td>
                    </tr>
                    <tr>
                        <td>Termín 3</td>
                        <td>ručně</td>
                        <td>čt 10-12</td>
                        <td>D105</td>
                        <td><x-go-trash-24 /></td>
                    </tr>
                </tbody>
            </table>
            <div class="d-grid gap-2 col-6 mx-auto">
                <a href="{{ route('my-courses') }}" class="btn btn-primary">Nový termín</a>
            </div>
        </x-card>
        <x-card>
            <x-slot:title>
                Seznam lektorů
            </x-slot:title>
            <table class="table align-middle">
                <thead>
                <tr>
                    <th scope="col"></th>
                    <th scope="col" class="small-button-column"></th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>Lektor Prvni</td>
                    <td><x-go-trash-24 /></td> {{-- TODO: on click actions --}}
                </tr>
                <tr>
                    <td>Lektor Druhy</td>
                    <td><x-go-trash-24 /></td>
                </tr>
                <tr>
                    <td>Lektor Treti</td>
                    <td><x-go-trash-24 /></td>
                </tr>
                </tbody>
            </table>
            <div class="d-grid gap-2 col-6 mx-auto">
                <a href="{{ route('my-courses') }}" class="btn btn-primary">Přidat lektora</a>
            </div>
        </x-card>
    @endif
</x-skeleton>
