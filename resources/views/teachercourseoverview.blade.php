<x-skeleton>
    <x-slot:title>
    {{$course->shortcut}}
    </x-slot:title>
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
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">Nejsou nalezené žadné termíny</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </x-card>

    <x-card>
        <x-slot:title>
            Seznam studentů
        </x-slot:title>
        <table class="table align-middle">
            <thead>
            <tr>
                <th scope="col"></th>
                <th scope="col" class="small-button-column"></th>
            </tr>
            </thead>
            <tbody>
                @forelse($students as $student)
                    <tr>
                        <td>{{ $student->name }} {{ $student->surname }}</td>
                        <td>
                            @if(Auth::user()->role == 'admin' || $course->guarantorID == Auth::id())
                                <button type="button" class="btn btn-link" onclick="showToast('confirmationToast', {{ $student->id }})">
                                    <x-go-trash-24 />
                                </button>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="2" class="text-center">Nejsou nalezeni žádní studenti</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </x-card>

    <div id="confirmationToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-body">
            Opravdu chcete tohoto studenta odebrat?
            <div class="mt-2 pt-2 border-top toast-buttons">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="toast">Ne</button>
                <form class="form-hidden" action="{{ route('delete-student') }}" method="get">
                    @csrf
                    <input type="hidden" id="confirmationToastID" name="id" />
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
