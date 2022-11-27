<x-skeleton>
    <x-slot:title>
        <span class="fw-bold">{{ $course->shortcut }} / {{ $term->name }}</span>
    </x-slot:title>

    <x-card>
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
                @foreach($students as $student)
                    <tr>
                        <td class="bold">{{ $student->login }}
                        <td>{{ $student->name }}</td>
                        <td>{{ $student->surname }}</td>
                        <td>
                            <input type="number" class="form-control @error($student->id) is-invalid @enderror" id="{{ $student->id }}" name="{{ $student->id }}" />
                        </td>
                        <td>{{ $student->studentScore ?? 0 }}</td>
                        <td>{{ $term->score }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <button type="submit" class="btn btn-primary">Ulozit</button>
        </form>
    </x-card>
</x-skeleton>