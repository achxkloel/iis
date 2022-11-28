<x-skeleton>
    <x-slot:title>
        Mé kurzy
    </x-slot:title>
    <div style="margin: 20px 0" class="d-flex justify-content-end">
        <a href="{{ route('course-create') }}" class="btn btn-success">
            <x-go-plus-16 style="margin: 0 2px" /> Přidat kurz
        </a>
    </div>
    <x-card>
        <x-slot:title>
        Aktuální kurzy
        </x-slot:title>
        <table class="table align-middle">
            <thead>
                <tr>
                    <th scope="col" class="shortcut-column">Zkratka</th>
                    <th scope="col">Název</th>
                    <th scope="col" class="small-button-column">Garant</th>
                    <th scope="col" class="small-button-column"></th>
                    <th scope="col" class="small-button-column"></th>
                    <th scope="col" class="small-button-column"></th>
                    <th scope="col" class="small-button-column"></th>
                </tr>
            </thead>
            <tbody>
                @forelse($teachingcourses as $teachingCourse)
                    <tr>
                        <td><a href="{{ route('course-detail', $teachingCourse->id) }}">{{ $teachingCourse->shortcut }}</a></td>
                        <td>{{ $teachingCourse->name }}</td>
                        <td class='text-center'>
                            @if($teachingCourse->guarantorID == Auth::id())
                                <x-go-check-circle-fill-16 class="text-success"/>
                            @endif
                        </td>
                        <td>
                            @if($teachingCourse->guarantorID == Auth::id() || Auth::user()->hasRole('admin'))
                                <a href="{{ route('course-edit', ['courseId' => $teachingCourse->id]) }}"><x-go-pencil-24 /></a>
                            @endif
                        </td>
                        <td>
                            @if($teachingCourse->guarantorID == Auth::id() || Auth::user()->hasRole('admin'))
                                <a href="{{ route('registration-management', ['courseId' => $teachingCourse->id]) }}"><x-go-versions-24 /></a>
                            @endif
                        </td>
                        <td>
                            @if($teachingCourse->guarantorID == Auth::id() || Auth::user()->hasRole('admin'))
                                <a href="{{ route('registration-management', ['courseId' => $teachingCourse->id]) }}"><x-go-trash-24 class='text-danger'/></a>
                            @endif
                        </td>
                        <td>
                            <a href="#"><x-go-info-24/></a>
                        </td>
                    </tr>

                @empty
                    <tr>
                        <td colspan="7" class="text-center">Nejsou nalezené žadné kurzy</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </x-card>

    <x-card>
        <x-slot:title>
            Kurzy ke schválení
        </x-slot:title>
        <table class="table align-middle">
            <thead>
                <tr>
                    <th scope="col" class="shortcut-column">Zkratka</th>
                    <th scope="col">Název</th>
                    <th scope="col" class="small-button-column"></th>
                    <th scope="col" class="small-button-column"></th>
                </tr>
            </thead>
            <tbody>
                @forelse($unconfirmedcourses as $unconfirmedCourse)
                    <tr>
                        <td class="bold"><a href="{{ route('course-detail', $unconfirmedCourse->id) }}">{{ $unconfirmedCourse->shortcut }}</a></td>
                        <td>{{ $unconfirmedCourse->name }}</td>
                        <td><a href="{{ route('course-edit', ['courseId' => $unconfirmedCourse->id]) }}"><x-go-pencil-24 /></a></td>
                        <td><a href="{{ route('registration-management', ['courseId' => $unconfirmedCourse->id]) }}"><x-go-trash-24 class='text-danger'/></a></td>
                    </tr>

                @empty
                    <tr>
                        <td colspan="6" class="text-center">Nejsou nalezené žadné kurzy</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </x-card>
</x-skeleton>
