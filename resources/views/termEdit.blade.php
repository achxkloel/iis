<x-skeleton>
    <x-slot:title>
        @if(Route::is('course-new-term'))
            Nový termín
        @else
            Upravit termín
        @endif
    </x-slot:title>
    <x-card>
        <form action="{{ Route::is('course-new-term') ? route('course-new-term', $courseId) : route('course-edit-term', ['courseId' => $courseId, 'termId' => $term->id]) }}" method="post">
            @csrf
            <div class="mb-3 row">
                <label for="name" class="col-sm-2 col-form-label required-label">Název</label>
                <div class="col-sm-10">
                    <input id="name" name="name" class="form-control @error('name') is-invalid @enderror" type="text" value="{{ $term->name ?? old('name') }}">
                    @error('name')
                        <div class="invalid-feedback text-start">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="mb-3 row">
                <label for="description" class="col-sm-2 col-form-label">Popis</label>
                <div class="col-sm-10">
                    <input id="description" name="description" class="form-control" type="text" value="{{ $term->description ?? old('description') }}">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="type" class="col-sm-2 col-form-label required-label">Typ</label>
                <div class="col-sm-10">
                    <input id="type" name="type" class="form-control @error('type') is-invalid @enderror" type="text" value="{{ $term->type ?? old('type') }}">
                    @error('type')
                        <div class="invalid-feedback text-start">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="mb-3 row">
                <label for="room" class="col-sm-2 col-form-label">Místnost</label>
                <div class="col-sm-10">
                    <select id="room" name="room" class="form-select">
                        <option>Nevybráno</option>
                        @foreach($rooms as $room)
                            <option @if($room->id == $term->classID) selected @endif value="{{ $room->id }}">{{ $room->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="score" class="col-sm-2 col-form-label required-label">Max. bodů</label>
                <div class="col-sm-10">
                    <input id="score" name="score" class="form-control @error('score') is-invalid @enderror" type="text" value="{{ $term->score ?? old('score') }}">
                    @error('score')
                        <div class="invalid-feedback text-start">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="mb-3 row">
                <label for="duration_from" class="col-sm-2 col-form-label">Začátek</label>
                <div class="col-sm-10">
                    <input type="number" class="form-control @error('duration_from') is-invalid @enderror" id="duration_from" name="duration_from" value="{{ $term->duration_from ?? old('duration_from') }}" aria-describedby="durationFromError">
                    @error('duration_from')
                        <div id="durationFromError" class="invalid-feedback text-start">
                            {{ $message }}
                        </div>
                    @enderror
                    <div class="form-text text-start">V hodinách od 8 do 20</div>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="duration_to" class="col-sm-2 col-form-label">Konec</label>
                <div class="col-sm-10">
                    <input type="number" class="form-control @error('duration_to') is-invalid @enderror" id="duration_to" name="duration_to" value="{{ $term->duration_to ?? old('duration_to') }}" aria-describedby="durationToError">
                    @error('duration_to')
                        <div id="durationToError" class="invalid-feedback text-start">
                            {{ $message }}
                        </div>
                    @enderror
                    <div class="form-text text-start">V hodinách od 9 do 21</div>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="day" class="col-sm-2 col-form-label">Den</label>
                <div class="col-sm-10">
                    <select class="form-select @error('day') is-invalid  @enderror" id="day" name="day" value="{{ $term->day ?? old('day') }}" aria-describedby="dayError" >
                        <option value="" {{ ($term->day ?? old('day')) == '' ? "selected" : "" }}>Nevybráno</option>
                        <option value="1" {{ ($term->day ?? old('day')) == '1' ? "selected" : "" }}>Pondělí</option>
                        <option value="2" {{ ($term->day ?? old('day')) == '2' ? "selected" : "" }}>Úterý</option>
                        <option value="3" {{ ($term->day ?? old('day')) == '3' ? "selected" : "" }}>Středa</option>
                        <option value="4" {{ ($term->day ?? old('day')) == '4' ? "selected" : "" }}>Čtvrtek</option>
                        <option value="5" {{ ($term->day ?? old('day')) == '5' ? "selected" : "" }}>Pátek</option>
                    </select>
                    @error('day')
                        <div id="dayError" class="invalid-feedback text-start">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="mb-3 row">
                <label for="capacity" class="col-sm-2 col-form-label required-label">Kapacita</label>
                <div class="col-sm-10">
                    <input id="capacity" name="capacity" class="form-control @error('capacity') is-invalid @enderror" type="text" value="{{ $term->capacity ?? old('capacity') }}">
                    @error('capacity')
                        <div class="invalid-feedback text-start">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="d-grid gap-2 col-6 mx-auto">
                <button type="submit" class="btn btn-primary">Uložit</button>
            </div>
        </form>
    </x-card>
</x-skeleton>
