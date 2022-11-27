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

        @if (Session::has('success'))
            <div class="alert alert-success text-start" role="alert">
                <h4 class="alert-heading">Uživatel byl úspěšně vytvořen</h4>
                <p>Po aktualizaci stranky heslo nebude dostupné!</p>
                <hr>
                <p class="mb-0">
                    <div>Login: <span class="fw-bold">{{ Session::get('login') }}</span></div>
                    <div>Heslo: <span class="fw-bold">{{ Session::get('password') }}</span></div>
                </p>
            </div>
        @endif

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
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach($persons as $person)
                <tr data-id="{{ $person->id }}">
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
                    <td class="fit">
                        <button type="button" class="btn btn-link" onclick="showToast('confirmationToast', {{ $person->id }})">
                            <x-go-circle-x-fill-16 class="text-danger"/>
                        </button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </x-card>

    <div id="confirmationToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-body">
            <p>Opravdu si přejete smazat tohoto uživatele?</p>
            <div class="mt-2 pt-2 border-top toast-buttons">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="toast">Ne</button>
                <form class="form-hidden" action="{{ route('admin-delete-person') }}" method="post">
                    @csrf
                    @method('delete')
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
