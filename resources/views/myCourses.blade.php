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
                                <button type="button" class="btn btn-link" onclick="showToast('confirmationToast', {{ $teachingCourse->id }})"><x-go-trash-24 class='text-danger'/></button>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('teacher-course-overview', ['courseId' => $teachingCourse->id]) }}"><x-go-info-24/></a>
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
                        <td>
                            @if($unconfirmedCourse->guarantorID == Auth::id() || Auth::user()->hasRole('admin'))
                                <button type="button" class="btn btn-link" onclick="showToast('confirmationToast', {{ $unconfirmedCourse->id }})"><x-go-trash-24 class='text-danger'/></button>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">Nejsou nalezené žadné kurzy</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </x-card>

    <div id="confirmationToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-body">
            <p>Opravdu si přejete smazat tento kurz?</p>
            <div class="mt-2 pt-2 border-top toast-buttons">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="toast">Ne</button>
                <form class="form-hidden" action="{{ route('delete-course') }}" method="get">
                    @csrf
                    <input type="hidden" id="confirmationToastID" name="id" />
                    <button type="submit" class="btn btn-danger">Ano</button>
                </form>
            </div>
        </div>
    </div>

    <x-slot:js>
        <script>
            function showToast(element, id) {
                const toastElement = document.getElementById(element);
                const toast = new bootstrap.Toast(toastElement);
                toast.show();

                document.getElementById(element + 'ID').value = id;
            }
        </script>
    </x-slot:js>
</x-skeleton>
