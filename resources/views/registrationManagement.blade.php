<x-skeleton>
    <x-slot:title>
        Správa registrací
    </x-slot:title>
    <x-card>
        <x-slot:title>
            Studenti registrující se na {{ $course->name }}
        </x-slot:title>
        <a class="btn btn-primary">Potvrdit vše</a>
        <a class="btn btn-outline-primary">Odmítnout vše</a>
        <table class="table align-middle">
            <thead>
                <tr>
                    <th scope="col"></th>
                    <th scope="col" class="button-column"></th>
                    <th scope="col" class="button-column"></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Jmeno Prijmeni</td>
                    <td><a class="table-button btn btn-primary">Potvrdit</a></td>
                    <td><a class="table-button btn btn-outline-primary">Odmítnout</a></td>
                </tr>
                <tr>
                    <td>Jmeno Prijmeni</td>
                    <td><a class="table-button btn btn-primary">Potvrdit</a></td>
                    <td><a class="table-button btn btn-outline-primary">Odmítnout</a></td>
                </tr>
                <tr>
                    <td>Jmeno Prijmeni</td>
                    <td><a class="table-button btn btn-primary">Potvrdit</a></td>
                    <td><a class="table-button btn btn-outline-primary">Odmítnout</a></td>
                </tr>
            </tbody>
        </table>
    </x-card>
</x-skeleton>
