<x-skeleton>
    <x-slot:title>
        Nová místnost
    </x-slot:title>
    <x-card>
        <form action="{{ route('admin-create-class') }}" method="post">
            @csrf
            
            <div class="mb-3 row">
                <label for="name" class="col-sm-2 col-form-label required-label">Název</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" aria-describedby="nameError">
                    @error('name')
                        <div id="nameError" class="invalid-feedback text-start">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="mb-3 row">
                <label for="description" class="col-sm-2 col-form-label">Popis</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control @error('description') is-invalid @enderror" id="description" name="description" value="{{ old('description') }}" aria-describedby="descriptionError">
                    @error('description')
                        <div id="descriptionError" class="invalid-feedback text-start">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="mb-3 row">
                <label for="type" class="col-sm-2 col-form-label required-label">Typ</label>
                <div class="col-sm-10">
                    <select class="form-select @error('type') is-invalid  @enderror" id="type" name="type" value="{{ old('type') }}" aria-describedby="typeError" >
                        <option value="lecture_room" {{ old('type') == 'lecture_room' ? "selected" : "" }}>Lecture Room</option>
                        <option value="lab" {{ old('type') == 'lab' ? "selected" : "" }}>Laboratory</option>
                        <option value="computer_lab" {{ old('type') == 'computer_lab' ? "selected" : "" }}>PC Laboratory</option>
                    </select>
                    @error('type')
                        <div id="typeError" class="invalid-feedback text-start">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="mb-3 row">
                <label for="capacity" class="col-sm-2 col-form-label required-label">Počet míst</label>
                <div class="col-sm-10">
                    <input type="number" class="form-control @error('capacity') is-invalid @enderror" id="capacity" name="capacity" value="{{ old('capacity') }}" aria-describedby="capacityError">
                    @error('capacity')
                        <div id="capacityError" class="invalid-feedback text-start">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="mb-3 row">
                <label for="floor" class="col-sm-2 col-form-label">Patro</label>
                <div class="col-sm-10">
                    <input type="number" class="form-control @error('floor') is-invalid @enderror" id="floor" name="floor" value="{{ old('floor') }}" aria-describedby="floorError">
                    @error('floor')
                        <div id="floorError" class="invalid-feedback text-start">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <!-- Submit button -->
            <button type="submit" class="btn btn-primary">Vytvořit</button>
        </form>
    </x-card>
</x-skeleton>