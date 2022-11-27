<x-skeleton>
    <x-card>
        <x-slot:title>
            {{ $course->shortcut }} - {{ $course->name }}
        </x-slot:title>
        <p>Garantem předmětu je {{ $course->guarantor->name }} {{ $course->guarantor->surname }}</p>
        <p>{{ $course->description }}</p>

        <div class="course-detail-info">
            <div>
                Cena
                <div class="course-detail-number">{{ $course->price ?? 0 }}</div>
                Kč
            </div>
            <div>
                Kapacita
                <div class="course-detail-number">{{ $course->capacity }}</div>
                lidí
            </div>
        </div>
    </x-card>
</x-skeleton>
