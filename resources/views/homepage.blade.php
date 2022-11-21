<x-skeleton>
    <div style="display: flex; flex-direction: column; align-items: center">
        <div class="input-group mb-3" style="width: 50%;">
            <input type="text" class="form-control" placeholder="Vyhledávání v předmětech" aria-label="Vyhledávání v předmětech" aria-describedby="button-addon2">
            <button class="btn btn-outline-secondary" type="button" id="button-addon2">Vyhledat</button>
        </div>
        <div style="display: flex; flex-wrap: wrap; justify-content: center">
            @foreach($courses as $course)
                <div class="card" style="width: 25rem; margin: 10px;">
                    <div class="card-body">
                        <h5 class="card-title">{{ $course->shortcut }} - {{ $course->name }}</h5>
                        <h6 class="card-subtitle mb-2 text-muted">{{ $course->guarantor }}</h6>
                        @if(Auth::check() && (Auth::user()->role == 'student' || Auth::user()->role == 'admin'))
                            <a href="#" class="card-link">Registrovat</a>
                        @endif
                        <a href="#" class="card-link">Přejít na detail předmětu</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-skeleton>
