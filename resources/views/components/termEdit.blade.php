{{-- TODO --}}
<x-skeleton>
    <x-slot:title>
        @if(Route::is('course-create'))
            Nový termín
        @else
            Upravit termín
        @endif
    </x-slot:title>
    <x-card>
        <form action="{{ Route::is('term-create') ? route('term-create') : route('term-edit', $term->id) }}" method="post">
            @csrf
            <div class="mb-3 row">
                <label for="name" class="col-sm-2 col-form-label required-label">Název</label>
                <div class="col-sm-10">
                    <input id="name" name="name" class="form-control @error('name') is-invalid @enderror" type="text" value="{{ $course->name }}">
                    @error('name')
                    <div class="invalid-feedback text-start">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>
            <div class="mb-3 row">
                <label for="description" class="col-sm-2 col-form-label required-label">Popis</label>
                <div class="col-sm-10">
                    <input id="description" name="description" class="form-control @error('description') is-invalid @enderror" type="text" value="{{ $course->description }}">
                    @error('description')
                    <div class="invalid-feedback text-start">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>
            <div class="mb-3 row">
                <label for="description" class="col-sm-2 col-form-label required-label">Typ</label>
                <div class="col-sm-10">
                    <input id="description" name="description" class="form-control @error('type') is-invalid @enderror" type="text" value="{{ $course->description }}">
                    @error('type')
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
