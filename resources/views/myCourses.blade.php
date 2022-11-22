<x-skeleton>
    <x-slot:title>
        Mé kurzy
    </x-slot:title>
    <x-card>
        <table class="table align-middle">
            <thead>
                <tr>
                    <th scope="col">Kurz</th>
                    <th scope="col" class="button-column"></th>
                    <th scope="col" class="button-column">
                        <a class="table-button btn btn-primary">Nový kurz</a>
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Kurz 1</td>
                    <td><a href="{{ route('course-edit', ['courseId' => 0]) }}" class="table-button btn btn-primary">Upravit</a></td>
                    <td><a href="{{ route('registration-management', ['courseId' => 0]) }}" class="table-button btn btn-primary">Správa registrací</a></td>
                </tr>
                <tr>
                    <td>Kurz 2</td>
                    <td><a class="table-button btn btn-primary">Upravit</a></td>
                    <td><a class="table-button btn btn-primary">Správa registrací</a></td>
                </tr>
                <tr>
                    <td>Kurz 3</td>
                    <td><a class="table-button btn btn-primary">Upravit</a></td>
                    <td><a class="table-button btn btn-primary">Správa registrací</a></td>
                </tr>
            </tbody>
        </table>
    </x-card>
</x-skeleton>
