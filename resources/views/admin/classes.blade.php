<x-skeleton>
    <x-slot:title>
        Místnosti
    </x-slot:title>

    <div style="margin: 20px 0" class="d-flex justify-content-end">
        <a href="{{ route('admin-create-class') }}" class="btn btn-success">
            <x-go-plus-16 style="margin: 0 2px" /> Přidat místnost
        </a>
    </div>

    <x-card>
        
        @if (Session::has('success'))
            <div class="alert alert-success text-start" role="alert">
                Místnost <span class="fw-bold">{{ Session::get('name') }}</span> byla úspěšně vytvořená
            </div>
        @endif

        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col">Jméno</th>
                <th scope="col">Popis</th>
                <th scope="col">Typ</th>
                <th scope="col">Patro</th>
                <th scope="col">Počet míst</th>
                <th scope="col">Vytvoření</th>
                <th scope="col">Změna</th>
            </tr>
            </thead>
            <tbody>
            @foreach($classes as $class)
                <tr data-id="{{ $class->id }}">
                    <td>{{ $class->name }}</td>
                    <td>{{ $class->description }}</td>
                    <td>{{ $class->type }}</td>
                    <td>{{ $class->floor }}</td>
                    <td>{{ $class->capacity }}</td>
                    <td>{{ $class->created_at }}</td>
                    <td>{{ $class->updated_at }}</td>
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
                    <h5 class="modal-title">Místnost <span id="modalClassName" class="fw-bold"></span></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Opravdu si přejete smazat zvolenou místnost?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Ne</button>
                    <form class="form-hidden" action="{{ route('admin-delete-class') }}" method="post">
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
                    const className = row.find("td:nth-child(1)").text();
                    const classID = row.data('id');
                    jQuery('#modalClassName').text(className);
                    document.getElementById('deleteID').value = classID;
                });
            });
        </script>
    </x-slot:js>
</x-skeleton>