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

        {{-- <table class="table table-bordered border-dark table-hover align-middle text-center multirow" style="table-layout: fixed">
            <thead class="table-dark">
                <tr>
                    <th style="width: 74px" scope="col"> </th>
                    <th scope="col">8:00</th>
                    <th scope="col">9:00</th>
                    <th scope="col">10:00</th>
                    <th scope="col">11:00</th>
                    <th scope="col">12:00</th>
                    <th scope="col">13:00</th>
                    <th scope="col">14:00</th>
                    <th scope="col">15:00</th>
                    <th scope="col">16:00</th>
                    <th scope="col">17:00</th>
                    <th scope="col">18:00</th>
                    <th scope="col">19:00</th>
                    <th scope="col">20:00</th>
                </tr>
            </thead>
            <tbody>
                <tr class="text-white">
                    <th class="table-dark text-center align-middle" scope="row">Pondělí</th>
                    <td class="bg-success" colspan="2"> <p class="fw-bold fs-4 lh-1">ISA</p> <p class="fst-italic lh-1">prednaska</p> <p class="lh-1">A100</p> <p class="small lh-1">Name Surname</p></td>
                    <td class="bg-primary">ISA cviceni</td>
                    <td class="bg-success">IMP prednaska</td>
                    <td class="bg-warning">IMP lab.cviceni</td>
                    <td class="bg-info">IMP demo cviceni</td>
                </tr>
                <tr>
                    <th class="table-dark text-center align-middle" scope="row">Úterý</th>
                    <td colspan="2" style="padding: 0">
                        <p class="bg-primary" style="height: 50px; font-size: 15">ISA cviceni</p>
                        <p class="bg-success" style="height: 50px">IMP cviceni</p>
                    </td>
                    <td style="padding: 0">
                        <div class="bg-success" style="height: 50px">IMP cviceni</div>
                    </td>
                </tr>
                <tr >
                    <th class="table-dark text-center align-middle" scope="row">Středa</th>
                </tr>
                <tr>
                    <th class="table-dark text-center align-middle" scope="row">Čtvrtek</th>
                </tr>
                <tr>
                    <th class="table-dark text-center align-middle" scope="row">Pátek</th>
                </tr>
            </tbody>
            <tfoot class="table-dark">
                <tr>
                    <th scope="col"> </th>
                    <th scope="col">8:00</th>
                    <th scope="col">9:00</th>
                    <th scope="col">10:00</th>
                    <th scope="col">11:00</th>
                    <th scope="col">12:00</th>
                    <th scope="col">13:00</th>
                    <th scope="col">14:00</th>
                    <th scope="col">15:00</th>
                    <th scope="col">16:00</th>
                    <th scope="col">17:00</th>
                    <th scope="col">18:00</th>
                    <th scope="col">19:00</th>
                    <th scope="col">20:00</th>
                </tr>
            </tfoot>
        </table> --}}
</x-skeleton>