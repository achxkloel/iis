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
</x-skeleton>