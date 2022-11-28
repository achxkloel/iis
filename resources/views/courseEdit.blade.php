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
                    <input id="name" name="name" class="form-control @error('name') is-invalid @enderror" type="text" value="{{ $course->name ?? old('name') }}">
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
                    <input id="shortcut" name="shortcut" class="form-control @error('shortcut') is-invalid @enderror" type="text" value="{{ $course->shortcut ?? old('shortcut') }}">
                    @error('shortcut')
                        <div class="invalid-feedback text-start">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="mb-3 row">
                <label for="description" class="col-sm-2 col-form-label">Popis</label>
                <div class="col-sm-10">
                    <input id="description" name="description" class="form-control @error('description') is-invalid @enderror" type="text" value="{{ $course->description ?? old('description') }}">
                    @error('description')
                        <div class="invalid-feedback text-start">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="mb-3 row">
                <label for="date_from" class="col-sm-2 col-form-label required-label">Začátek</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control @error('date_from') is-invalid @enderror" id="date_from" name="date_from" value="{{ $course->date_from?->format('d.m.Y') ?? old('date_from') }}" aria-describedby="dateFromError">
                    @error('date_from')
                        <div id="dateFromError" class="invalid-feedback text-start">
                            {{ $message }}
                        </div>
                    @enderror
                    <div class="form-text text-start">Příklad: {{ now()->isoFormat('DD.MM.YYYY') }}</div>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="date_to" class="col-sm-2 col-form-label required-label">Konec</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control @error('date_to') is-invalid @enderror" id="date_to" name="date_to" value="{{ $course->date_to?->format('d.m.Y') ?? old('date_to') }}" aria-describedby="dateToError">
                    @error('date_to')
                        <div id="dateToError" class="invalid-feedback text-start">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="mb-3 row">
                <label for="capacity" class="col-sm-2 col-form-label required-label">Limit</label>
                <div class="col-sm-10 number-input">
                    <input id="capacity" name="capacity" class="form-control @error('capacity') is-invalid @enderror" type="text" value="{{ $course->capacity ?? old('capacity') }}">
                    @error('capacity')
                        <div class="invalid-feedback text-start">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="mb-3 row">
                <label for="price" class="col-sm-2 col-form-label">Cena</label>
                <div class="col-sm-10 number-input">
                    <input id="price" name="price" class="form-control @error('price') is-invalid @enderror" type="text" value="{{ $course->price ?? old('price') }}">
                    @error('price')
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
                        <th scope="col">Čas</th>
                        <th scope="col" class="small-button-column"></th>
                        <th scope="col" class="small-button-column"></th>
                        <th scope="col" class="small-button-column"></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($terms as $term)
                        <tr>
                            <td>{{ $term->name }}</td>
                            <td>{{ $term->type }}</td>
                            <td>{{ $term->class?->name }}</td>
                            <td>{{ ($term->day) ? $days[$term->day - 1] . " " . $term->duration_from . ":00 - " . $term->duration_to . ":00" : "-" }}</td>
                            <td><a href="{{ route('course-term-students', ['courseId' => $course->id, 'termId' => $term->id]) }}"><x-go-person-24 /></a></td>
                            <td><a href="{{ route('course-edit-term', ['courseId' => $course->id, 'termId' => $term->id]) }}"><x-go-pencil-24 /></a></td>
                            <td>
                                <button type="button" class="btn btn-link" onclick="showToast('confirmationToastTerm', {{ $term->id }})">
                                    <x-go-trash-24 />
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">Nejsou nalezené žadné termíny</td>
                        </tr>
                    @endforelse
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
                    @forelse($teacherCourse as $item)
                        <tr>
                            <td>{{ $item->teacher->first()->name }} {{ $item->teacher->first()->surname }}</td>
                            <td>
                                <button type="button" class="btn btn-link" onclick="showToast('confirmationToastTeacher', {{ $item->id }})">
                                    <x-go-trash-24 />
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="2" class="text-center">Nejsou nalezeni žádní lektoři</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <form action="{{ route('add-teacher', $course->id) }}" class="add-teacher-select">
                <div class="input-group mb-3">
                    <select id="teacher" name="teacher" class="form-control">
                        <option>Nevybráno</option>
                        @foreach($teachers as $teacher)
                            <option value="{{ $teacher->id }}">{{ $teacher->name }} {{ $teacher->surname }}</option>
                        @endforeach
                    </select>
                    <button type="submit" class="btn btn-outline-secondary" id="button-addon2">Přidat</button>
                </div>
            </form>
        </x-card>
    @endunless

    <div id="confirmationToastTerm" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-body">
            Opravdu chcete tento termín smazat?
            <div class="mt-2 pt-2 border-top toast-buttons">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="toast">Ne</button>
                <form class="form-hidden" action="{{ route('course-delete-term') }}" method="get">
                    @csrf
                    <input type="hidden" id="confirmationToastTermID" name="id" />
                    <button type="submit" class="btn btn-danger">Ano</button>
                </form>
            </div>
        </div>
    </div>

    <div id="confirmationToastTeacher" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-body">
            Opravdu chcete tohoto učitele odebrat?
            <div class="mt-2 pt-2 border-top toast-buttons">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="toast">Ne</button>
                <form class="form-hidden" action="{{ route('delete-teacher') }}" method="get">
                    @csrf
                    <input type="hidden" id="confirmationToastTeacherID" name="id" />
                    <button type="submit" class="btn btn-danger">Ano</button>
                </form>
            </div>
        </div>
    </div>
    <x-slot:js>
        <script>
            function showToast(element, id) {
                const toastElement = document.getElementById(element);
                const toast = new bootstrap.Toast(toastElement);
                toast.show();

                document.getElementById(element + 'ID').value = id;
            }
        </script>
    </x-slot:js>
</x-skeleton>
