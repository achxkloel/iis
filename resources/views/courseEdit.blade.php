<x-skeleton>
    <x-slot:title>
        Upravit kurz {{-- TODO: create course --}}
    </x-slot:title>
    <x-card>
        <x-slot:title>
            Základní info
        </x-slot:title>
        <div class="mb-3 row">
            <label for="name" class="col-sm-2 col-form-label">Název</label>
            <div class="col-sm-10">
                <input id="name" class="form-control" type="text" value="{{ $course->name }}">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="surname" class="col-sm-2 col-form-label">Zkratka</label>
            <div class="col-sm-10">
                <input id="surname" class="form-control" type="text" value="{{ $course->shortcut }}">
            </div>
        </div>
        {{-- TODO: fields --}}
        <div class="d-grid gap-2 col-6 mx-auto">
            <a href="{{ route('my-courses') }}" class="btn btn-primary">Uložit</a>
        </div>
    </x-card>
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
</x-skeleton>
