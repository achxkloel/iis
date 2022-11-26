{{-- TODO --}}
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
                    <input id="name" name="name" class="form-control @error('name') is-invalid @enderror" type="text" value="{{ $term->name }}">
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
                    <input id="description" name="description" class="form-control" type="text" value="{{ $term->description }}">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="type" class="col-sm-2 col-form-label required-label">Typ</label>
                <div class="col-sm-10">
                    <input id="type" name="type" class="form-control @error('type') is-invalid @enderror" type="text" value="{{ $term->type }}">
                    @error('type')
                        <div class="invalid-feedback text-start">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="mb-3 row">
                <label for="score" class="col-sm-2 col-form-label required-label">Max. bodů</label>
                <div class="col-sm-10">
                    <input id="score" name="score" class="form-control @error('score') is-invalid @enderror" type="text" value="{{ $term->score }}">
                    @error('score')
                        <div class="invalid-feedback text-start">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="mb-3 row">
                <label for="date-from" class="col-sm-2 col-form-label required-label">Od</label>
                <div class="col-sm-10">
                    <input id="date-from" name="date-from" class="form-control @error('date-from') is-invalid @enderror" type="text" value="{{ $term->dateFrom }}">
                    @error('date-from')
                        <div class="invalid-feedback text-start">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="mb-3 row">
                <label for="date-to" class="col-sm-2 col-form-label required-label">Do</label>
                <div class="col-sm-10">
                    <input id="date-to" name="date-to" class="form-control @error('date-to') is-invalid @enderror" type="text" value="{{ $term->dateTo }}">
                    @error('date-to')
                        <div class="invalid-feedback text-start">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="mb-3 row">
                <label for="capacity" class="col-sm-2 col-form-label required-label">Kapacita</label>
                <div class="col-sm-10">
                    <input id="capacity" name="capacity" class="form-control @error('capacity') is-invalid @enderror" type="text" value="{{ $term->capacity }}">
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
