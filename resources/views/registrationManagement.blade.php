<x-skeleton>
    <x-slot:title>
        Správa registrací
    </x-slot:title>
    <x-card>
        <x-slot:title>
            Studenti registrující se na {{ $course->name }}
        </x-slot:title>
        <a href="{{ route('confirm-all-registrations', $course->id) }}" class="btn btn-primary">Potvrdit vše</a>
        <a href="{{ route('delete-all-registrations', $course->id) }}" class="btn btn-outline-primary">Odmítnout vše</a>
        <table class="table align-middle">
            <thead>
                <tr>
                    <th scope="col"></th>
                    <th scope="col" class="button-column"></th>
                    <th scope="col" class="button-column"></th>
                </tr>
            </thead>
            <tbody>
                @forelse($studentCourse as $student)
                    <tr>
                        <td>{{ $student->student->name }} {{ $student->student->surname }}</td>
                        <td><a href="{{ route('confirm-registration', ['courseId' => $course->id, 'studentCourseId' => $student->id]) }}" class="table-button btn btn-primary">Potvrdit</a></td>
                        <td><a href="{{ route('delete-registration', ['courseId' => $course->id, 'studentCourseId' => $student->id]) }}" class="table-button btn btn-outline-primary">Odmítnout</a></td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-center">Nejsou nalezené žadné registrace</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </x-card>
</x-skeleton>
