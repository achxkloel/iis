<x-skeleton>
    <div style="display: flex; flex-direction: column; align-items: center">
        @if (Session::has('register_error'))
            <div style="width:100%" class="alert alert-danger" role="alert">
                {{ Session::get('register_error') }}
            </div>
        @endif
        <form action="{{ route('homepage') }}" method="GET" class="fulltext-bar">
            <div class="input-group mb-3">
                <input name="fulltext" type="text" class="form-control" placeholder="Vyhledávání v předmětech">
                <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Vyhledat</button>
            </div>
        </form>
        <div style="display: flex; flex-wrap: wrap; justify-content: center">
            @foreach($unregistered as $course)
                <div class="card" style="width: 25rem; margin: 10px;">
                    <div class="card-body">
                        <h5 class="card-title">{{ $course->shortcut }} - {{ $course->name }}</h5>
                        <h6 class="card-subtitle mb-2 text-muted">{{ $course->guarantor->name }} {{ $course->guarantor->surname }}</h6>
                            <a href="{{ route('homepage-regcourse', $course->id) }}" class="card-link">Registrovat</a>
                        <a href="{{ route('course-detail', $course->id) }}" class="card-link">Přejít na detail předmětu</a>
                    </div>
                </div>
            @endforeach
                @foreach($registered as $course)
                    <div class="card" style="width: 25rem; margin: 10px;">
                        <div class="card-body">
                            <h5 class="card-title">{{ $course->shortcut }} - {{ $course->name }}</h5>
                            <h6 class="card-subtitle mb-2 text-muted">{{ $course->guarantor->name }} {{ $course->guarantor->surname }}</h6>
                            @if(Auth::check())
                                <a class="card-link link-disabled" aria-disabled="true">Registrováno</a>
                            @endif
                            <a href="{{ route('course-detail', $course->id) }}" class="card-link">Přejít na detail předmětu</a>
                        </div>
                    </div>
                @endforeach
        </div>
    </div>
</x-skeleton>
