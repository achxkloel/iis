<x-skeleton>
    <div style="display: flex; flex-direction: column; align-items: center">
        <form action="{{ route('homepage') }}" method="GET" class="fulltext-bar">
            <div class="input-group mb-3">
                <input name="fulltext" type="text" class="form-control" placeholder="Vyhledávání v předmětech">
                <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Vyhledat</button>
            </div>
        </form>
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
