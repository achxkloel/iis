<x-skeleton>
    <x-slot:title>
        Přehled studia
    </x-slot:title>
    <x-card>
        <x-slot:title>
            {{ $course->name }} - 69
        </x-slot:title>
        <table class="table align-middle">
            <thead>
                <tr>
                    <th scope="col">Termín</th>
                    <th scope="col" class="button-column">Registrace</th>
                </tr>
            </thead>
            <tbody>
            @foreach($terms as $term)
                <tr>
                    <td>{{$term->name}}</td>
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
            @endforeach
            </tbody>
        </table>
    </x-card>
</x-skeleton>
