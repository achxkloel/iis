<x-skeleton>
    <x-slot:title>
        <span class="fw-bold">{{ $course->shortcut }} / {{ $term->name }}</span>
    </x-slot:title>

    <x-card>
        <x-slot:title>
            <span class="fw-bold">Seznam studentů kurzu</span>
        </x-slot:title>
        <form class="form-hidden" action="{{ route('course-term-students', ['courseId' => $course->id, 'termId' => $term->id]) }}" method="post">
            @csrf

            <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col">Login</th>
                    <th scope="col">Jméno</th>
                    <th scope="col">Příjmení</th>
                    <th scope="col">Nové hod.</th>
                    <th scope="col">Staré hod.</th>
                    <th scope="col">Limit</th>
                    <th scope="col" class="small-button-column"></th>
                </tr>
                </thead>
                <tbody>
                @forelse($students as $student)
                    <tr>
                        <td class="bold">{{ $student->login }}
                        <td>{{ $student->name }}</td>
                        <td>{{ $student->surname }}</td>
                        <td>
                            <input type="number" class="form-control @error($student->id) is-invalid @enderror" id="{{ $student->id }}" name="{{ $student->id }}" />
                        </td>
                        <td>{{ $student->studentScore ?? '-' }}</td>
                        <td>{{ $term->score }}</td>
                        <td>
                            <button type="button" class="btn btn-link" onclick="showToast('confirmationToast', {{ $student->studentTermId }}, {{ $course->id }})">
                                <x-go-trash-24 />
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">Nejsou nalezené žadné studenti</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
            @if ($students)
                <button type="submit" class="btn btn-primary">Přidat hodnocení</button>
            @endif
        </form>
    </x-card>

    <div id="confirmationToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-body">
            Opravdu chcete tohoto studenta odebrat?
            <div class="mt-2 pt-2 border-top toast-buttons">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="toast">Ne</button>
                <form class="form-hidden" action="{{ route('delete-student-term') }}" method="get">
                    @csrf
                    <input type="hidden" id="confirmationToastID" name="id" />
                    <input type="hidden" id="confirmationToastCourseID" name="courseId" />
                    <button type="submit" class="btn btn-danger">Ano</button>
                </form>
            </div>
        </div>
    </div>

    <x-slot:js>
        <script>
            function showToast(element, id, courseId) {
                const toastElement = document.getElementById(element);
                const toast = new bootstrap.Toast(toastElement);
                toast.show();

                document.getElementById(element + 'ID').value = id;
                document.getElementById(element + 'CourseID').value = courseId;
            }
        </script>
    </x-slot:js>
</x-skeleton>
