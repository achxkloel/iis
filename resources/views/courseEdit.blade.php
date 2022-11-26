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
                        <div class="invalid-feedback text-start">
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
                        <div class="invalid-feedback text-start">
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
                        <div class="invalid-feedback text-start">
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
                        <div class="invalid-feedback text-start">
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
    @unless(Route::is('course-create'))
        <x-card>
            <x-slot:title>
                Seznam termínů
            </x-slot:title>
            <table class="table align-middle">
                <thead>
                    <tr>
                        <th scope="col">Název</th>
                        <th scope="col">Typ</th>
                        <th scope="col">Místnost</th>
                        <th scope="col" class="small-button-column"></th>
                        <th scope="col" class="small-button-column"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($terms as $term)
                        <tr>
                            <td>{{ $term->name }}</td>
                            <td>{{ $term->type }}</td>
                            <td>{{ $term->class?->name }}</td>
                            <td><a href="{{ route('course-edit-term', ['courseId' => $course->id, 'termId' => $term->id]) }}"><x-go-pencil-24 /></a></td>
                            <td><a href="{{ route('course-delete-term', ['courseId' => $course->id, 'termId' => $term->id]) }}"><x-go-trash-24 /></a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="d-grid gap-2 col-6 mx-auto">
                <a href="{{ route('course-new-term', ['courseId' => $course->id]) }}" class="btn btn-primary">Nový termín</a>
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
    @endunless
</x-skeleton>
