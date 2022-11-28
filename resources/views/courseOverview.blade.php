<x-skeleton>
    <x-slot:title>
        Přehled studia
    </x-slot:title>
    <x-card>
        <x-slot:title>
            {{ $course->name }}
        </x-slot:title>
        <table class="table align-middle">
            <thead>
                <tr>
                    <th scope="col">Termín</th>
                    <th scope="col">Hodnocení</th>
                    <th scope="col">Čas</th>
                    <th scope="col" class="button-column">Registrace</th>
                </tr>
            </thead>
            <tbody>
            @forelse($terms as $term)
                <tr>
                    <td>{{$term->name}}</td>
                    <td>{{ in_array($term->id, $userterms_ids) ? $userterms[array_search($term->id, $userterms_ids, true)]->studentScore ?? '-' : '-' }}</td>
                    <td>{{ ($term->day) ? $days[$term->day - 1] . " " . $term->duration_from . ":00 - " . $term->duration_to . ":00" : "-" }}</td>
                    <td>
                        @if(!$term->open)
                            <button type="button" class="table-button btn btn-outline-secondary" disabled>Nelze registrovat</button>
                        @elseif(in_array($term->id, $userterms->pluck('id')->all()))
                            <a href="{{ route('course-overview-unregterm', ['courseId'=>$course->id,'termId'=>$term->id]) }}" class="table-button btn btn-outline-primary">Odregistrovat</a>
                        @else
                            <a href="{{ route('course-overview-regterm', ['courseId'=>$course->id,'termId'=>$term->id]) }}" class="table-button btn btn-primary">Registrovat</a>
                        @endif                        
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="text-center">Nejsou nalezené žadné termíny</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </x-card>
</x-skeleton>
