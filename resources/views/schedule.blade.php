<x-skeleton>
    <x-slot:title>
        Rozvrh
    </x-slot:title>

    <x-card>
        <x-slot:title>
            Pondělí
        </x-slot:title>
        <table class="table table-striped align-middle">
            <thead>
                <tr>
                    <th width="15%" scope="col" class="shortcut-column">Kurz</th>
                    <th width="60%" scope="col">Termín</th>
                    <th width="25%" scope="col">Čas</th>
                </tr>
            </thead>
            <tbody>
            @forelse($monday as $term)
                <tr>
                    <td><a href="{{ route('course-detail', $term->courseID) }}">{{ $term->courseShortcut }}</a></td>
                    <td>{{ $term->name }}</td>
                    <td>{{ ($term->day) ? $term->duration_from . ":00 - " . $term->duration_to . ":00" : "-" }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="text-center">Nejsou žadné termíny</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </x-card>

    <x-card>
        <x-slot:title>
            Úterý
        </x-slot:title>
        <table class="table table-striped align-middle">
            <thead>
                <tr>
                    <th width="15%" scope="col" class="shortcut-column">Kurz</th>
                    <th width="60%" scope="col">Termín</th>
                    <th width="25%" scope="col">Čas</th>
                </tr>
            </thead>
            <tbody>
            @forelse($tuesday as $term)
                <tr>
                    <td><a href="{{ route('course-detail', $term->courseID) }}">{{ $term->courseShortcut }}</a></td>
                    <td>{{ $term->name }}</td>
                    <td>{{ ($term->day) ? $term->duration_from . ":00 - " . $term->duration_to . ":00" : "-" }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="text-center">Nejsou žadné termíny</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </x-card>

    <x-card>
        <x-slot:title>
            Středa
        </x-slot:title>
        <table class="table table-striped align-middle">
            <thead>
                <tr>
                    <th width="15%" scope="col" class="shortcut-column">Kurz</th>
                    <th width="60%" scope="col">Termín</th>
                    <th width="25%" scope="col">Čas</th>
                </tr>
            </thead>
            <tbody>
            @forelse($wednesday as $term)
                <tr>
                    <td><a href="{{ route('course-detail', $term->courseID) }}">{{ $term->courseShortcut }}</a></td>
                    <td>{{ $term->name }}</td>
                    <td>{{ ($term->day) ? $term->duration_from . ":00 - " . $term->duration_to . ":00" : "-" }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="text-center">Nejsou žadné termíny</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </x-card>

    <x-card>
        <x-slot:title>
            Čtvrtek
        </x-slot:title>
        <table class="table table-striped align-middle">
            <thead>
                <tr>
                    <th width="15%" scope="col" class="shortcut-column">Kurz</th>
                    <th width="60%" scope="col">Termín</th>
                    <th width="25%" scope="col">Čas</th>
                </tr>
            </thead>
            <tbody>
            @forelse($thursday as $term)
                <tr>
                    <td><a href="{{ route('course-detail', $term->courseID) }}">{{ $term->courseShortcut }}</a></td>
                    <td>{{ $term->name }}</td>
                    <td>{{ ($term->day) ? $term->duration_from . ":00 - " . $term->duration_to . ":00" : "-" }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="text-center">Nejsou žadné termíny</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </x-card>

    <x-card>
        <x-slot:title>
            Pátek
        </x-slot:title>
        <table class="table table-striped align-middle">
            <thead>
                <tr>
                    <th width="15%" scope="col" class="shortcut-column">Kurz</th>
                    <th width="60%" scope="col">Termín</th>
                    <th width="25%" scope="col">Čas</th>
                </tr>
            </thead>
            <tbody>
            @forelse($friday as $term)
                <tr>
                    <td><a href="{{ route('course-detail', $term->courseID) }}">{{ $term->courseShortcut }}</a></td>
                    <td>{{ $term->name }}</td>
                    <td>{{ ($term->day) ? $term->duration_from . ":00 - " . $term->duration_to . ":00" : "-" }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="text-center">Nejsou žadné termíny</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </x-card>

    <x-card>
        <x-slot:title>
            Bez času
        </x-slot:title>
        <table class="table table-striped align-middle">
            <thead>
                <tr>
                    <th width="50%" scope="col" class="shortcut-column">Kurz</th>
                    <th width="50%" scope="col">Termín</th>
                </tr>
            </thead>
            <tbody>
            @forelse($other as $term)
                <tr>
                    <td><a href="{{ route('course-detail', $term->courseID) }}">{{ $term->courseShortcut }}</a></td>
                    <td>{{ $term->name }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="2" class="text-center">Nejsou žadné termíny</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </x-card>
</x-skeleton>