<x-skeleton>
    <x-slot:title>
        Přehled studia
    </x-slot:title>
    <x-card>
        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col">Zkratka</th>
                <th scope="col">Název</th>
                <th scope="col">Garant</th>
                <th scope="col">Body</th>
            </tr>
            </thead>
            <tbody>
            @forelse($courses as $course)
                <tr>
                    <td class="bold"><a href="{{ route('course-overview', $course->id) }}">{{ $course->shortcut }}</a></td>
                    <td>{{ $course->name }}</td>
                    <td>{{ $course->guarantor->name }} {{ $course->guarantor->surname }}</td>
                    <td>69</td>
                </tr>
            @empty
            <tr>
                <td colspan="4" class="text-center">Nejsou nalezené žadné kurzy</td>
            </tr>
            @endforelse
            </tbody>
        </table>
    </x-card>
</x-skeleton>
