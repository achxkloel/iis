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
                        <th scope="col" class="small-button-column"></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($terms as $term)
                        <tr>
                            <td>{{ $term->name }}</td>
                            <td>{{ $term->type }}</td>
                            <td>{{ $term->class?->name }}</td>
                            <td><a href="{{ route('course-term-students', ['courseId' => $course->id, 'termId' => $term->id]) }}"><x-go-person-24 /></a></td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center">Nejsou nalezené žadné termíny</td>
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
                </tr>
                </thead>
                <tbody>
                    @forelse($students as $student)
                        <tr>
                            <td>{{ $student->name }} {{ $student->surname }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="1" class="text-center">Nejsou nalezené žadné studenti</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </x-card>
</x-skeleton>