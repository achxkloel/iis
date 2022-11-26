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
                        <a href="#" data-bs-toggle="modal" data-bs-target="#deleteConfirmModal"><x-go-circle-x-fill-16 class="text-danger"/></a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </x-card>
    
    <div class="modal fade" tabindex="-1" id="deleteConfirmModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Smazat</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Opravdu si přejete smazat uživatele <span id="modalLogin" class="fw-bold"></span>?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Ne</button>
                    <form class="form-hidden" action="{{ route('admin-delete-person') }}" method="post">
                        @csrf
                        @method('delete')
                        <input type="hidden" id="deleteID" name="id" />
                        <button type="submit" class="btn btn-danger">Ano</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <x-slot:js>
        <script>
            jQuery(document).ready(function () {
                jQuery('#deleteConfirmModal').on('show.bs.modal', function(e) {
                    const button = jQuery(e.relatedTarget);
                    const row = button.closest('tr');
                    const login = row.find("td:nth-child(1)").text();
                    const userID = row.data('id');
                    jQuery('#modalLogin').text(login);
                    document.getElementById('deleteID').value = userID;
                });
            });
        </script>
    </x-slot:js>
</x-skeleton>