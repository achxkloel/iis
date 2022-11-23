<x-skeleton>
    <x-slot:title>
        Uživatele
    </x-slot:title>

    <div style="margin: 20px 0" class="d-flex justify-content-end">
        <a href="{{ route('admin-create-person') }}" class="btn btn-success">
            <x-go-plus-16 style="margin: 0 2px" /> Přidat uživatele
        </a>
    </div>

    <x-card>
        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col">Login</th>
                <th scope="col">Jméno</th>
                <th scope="col">Příjmení</th>
                <th scope="col">Email</th>
                <th scope="col">Role</th>
                <th scope="col">Vytvoření</th>
                <th scope="col">Změna</th>
                <th class="fit" scope="col">Aktivní</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach($persons as $person)
                <tr>
                    <td class="bold">{{ $person->login }}
                    <td>{{ $person->name }}</td>
                    <td>{{ $person->surname }}</td>
                    <td>{{ $person->email }}</td>
                    <td>{{ $person->role }}</td>
                    <td>{{ $person->created_at }}</td>
                    <td>{{ $person->updated_at }}</td>
                    <td class="fit text-center">
                        @if ($person->is_active)
                            <x-go-check-circle-fill-16 class="text-success" />
                        @endif
                    </td>
                    <td class="fit"><a href="#"><x-go-circle-x-fill-16 class="text-danger"/></a></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </x-card>
</x-skeleton>