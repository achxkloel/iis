<x-skeleton>
    <x-slot:title>
        Mé kurzy
    </x-slot:title>
    <x-card>
        <table class="table align-middle">
            <thead>
                <tr>
                    <th scope="col" class="shortcut-column">Kurz</th>
                    <th scope="col"></th>
                    <th scope="col" class="button-column"></th>
                    <th scope="col" class="button-column">
                        <a href="{{ route('course-create') }}" class="table-button btn btn-primary">Nový kurz</a>
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach($courses as $course)
                    <tr>
                        <td>{{ $course->shortcut }}</td>
                        <td>{{ $course->name }}</td>
                        <td><a href="{{ route('course-edit', ['courseId' => $course->id]) }}" class="table-button btn btn-primary">Upravit</a></td>
                        <td><a href="{{ route('registration-management', ['courseId' => $course->id]) }}" class="table-button btn btn-primary">Správa registrací</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </x-card>
</x-skeleton>
