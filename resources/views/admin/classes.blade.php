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
        
        @if (Session::has('success_create'))
            <div class="alert alert-success text-start" role="alert">
                Místnost <span class="fw-bold">{{ Session::get('name') }}</span> byla úspěšně vytvořená
            </div>
        @endif

        @if (Session::has('success_update'))
            <div class="alert alert-success text-start" role="alert">
                Místnost <span class="fw-bold">{{ Session::get('name') }}</span> byla úspěšně aktualizovaná
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
                <th></th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @forelse($classes as $class)
                <tr data-id="{{ $class->id }}">
                    <td>{{ $class->name }}</td>
                    <td>{{ $class->description }}</td>
                    <td>{{ $class->type }}</td>
                    <td>{{ $class->floor }}</td>
                    <td>{{ $class->capacity }}</td>
                    <td>{{ $class->created_at }}</td>
                    <td>{{ $class->updated_at }}</td>
                    <td class="fit">
                        <a href="{{ route('admin-class', $class->id) }}"><x-go-pencil-16 class="text-secondary"/></a>
                    </td>
                    <td class="fit">
                        <button type="button" class="btn btn-link" onclick="showToast('confirmationToast', {{ $class->id }})">
                            <x-go-circle-x-fill-16 class="text-danger"/>
                        </button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="9" class="text-center">Nejsou nalezené žadné místnosti</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </x-card>
    
    <div id="confirmationToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-body">
            <p>Opravdu si přejete smazat místnost?</p>
            <div class="mt-2 pt-2 border-top toast-buttons">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="toast">Ne</button>
                <form class="form-hidden" action="{{ route('admin-delete-class') }}" method="post">
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