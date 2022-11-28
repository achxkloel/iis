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
                <th scope="col">Hodnocení</th>
                <th scope="col">Body</th>
                <th scope="col" class="small-button-column"></th>
            </tr>
            </thead>
            <tbody>
            @foreach($courses as $course)
                <tr>
                    <td class="bold"><a href="{{ route('course-detail', $course->id) }}">{{ $course->shortcut }}</a></td>
                    <td>{{ $course->name }}</td>
                    <td>D</td>
                    <td>69</td>
                    <td><a href="{{ route('course-overview', $course->id) }}"><x-go-arrow-right-24 /></a></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </x-card>
</x-skeleton>
