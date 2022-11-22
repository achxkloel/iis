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
                <tr>
                    <td>Termín 1</td>
                    <td><button type="button" class="table-button btn btn-primary">Registrovat</button></td>
                </tr>
                <tr>
                    <td>Termín 2</td>
                    <td><button type="button" class="table-button btn btn-outline-primary">Odregistrovat</button></td>
                </tr>
                <tr>
                    <td>Termín 3</td>
                    <td><button type="button" class="table-button btn btn-outline-secondary" disabled>Nelze registrovat</button></td>
                </tr>
            </tbody>
        </table>
    </x-card>
</x-skeleton>
