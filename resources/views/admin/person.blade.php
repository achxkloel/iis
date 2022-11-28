<x-skeleton>
    <x-slot:title>
        Uživatel <span class="fw-bold">{{ $person->name }} {{ $person->surname }}</span>
    </x-slot:title>

    <x-card>
        <form action="{{ route('admin-update-person', $person->id) }}" method="post">
            @csrf

            <div class="mb-3 row">
                <label for="login" class="col-sm-2 col-form-label">Login</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="login" value="{{ $person->login }}" disabled>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="name" class="col-sm-2 col-form-label required-label">Jméno</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ $person->name }}" aria-describedby="nameError">
                    @error('name')
                        <div id="nameError" class="invalid-feedback text-start">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="mb-3 row">
                <label for="surname" class="col-sm-2 col-form-label required-label">Příjmení</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control @error('surname') is-invalid @enderror" id="surname" name="surname" value="{{ $person->surname }}" aria-describedby="surnameError">
                    @error('surname')
                        <div id="surnameError" class="invalid-feedback text-start">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="mb-3 row">
                <label for="birth_date" class="col-sm-2 col-form-label">Datum narození</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control @error('birth_date') is-invalid @enderror" id="birth_date" name="birth_date" value="{{ $person->birth_date?->format('d.m.Y') }}" aria-describedby="birthDateError">
                    @error('birth_date')
                        <div id="birthDateError" class="invalid-feedback text-start">
                            {{ $message }}
                        </div>
                    @enderror
                    <div class="form-text text-start">Příklad: {{ now()->isoFormat('DD.MM.YYYY') }}</div>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="address" class="col-sm-2 col-form-label">Adresa</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control @error('address') is-invalid @enderror" id="address" name="address" value="{{ $person->address }}" aria-describedby="addressError">
                    @error('address')
                        <div id="addressError" class="invalid-feedback text-start">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="mb-3 row">
                <label for="phone_number" class="col-sm-2 col-form-label">Telefon</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control @error('phone_number') is-invalid @enderror" id="phone_number" name="phone_number" value="{{ $person->phone_number }}" aria-describedby="phoneNumberError">
                    @error('phone_number')
                        <div id="phoneNumberError" class="invalid-feedback text-start">
                            {{ $message }}
                        </div>
                    @enderror
                    <div class="form-text text-start">Příklad: +420 123 456 789</div>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="email" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ $person->email }}" aria-describedby="emailError">
                    @error('email')
                        <div id="emailError" class="invalid-feedback text-start">
                            {{ $message }}
                        </div>
                    @enderror
                    <div class="form-text text-start">Příklad: jan_novak49@example.com</div>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="role" class="col-sm-2 col-form-label">Role</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="role" value="{{ $person->role }}" disabled>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Změnit</button>
        </form>
    </x-card>

    <x-card>
        <x-slot:title>
            Nastavit nové heslo
        </x-slot:title>
        <form action="{{ route('admin-person-set-password', $person->id) }}" method="post">
            @csrf

            <div class="mb-3 row">
                <label for="newPassword" class="col-sm-3 col-form-label required-label">Nové heslo</label>
                <div class="col-sm-9">
                    <input type="password" class="form-control @error('newPassword') is-invalid @enderror" id="newPassword" name="newPassword" aria-describedby="newPasswordError">
                    @error('newPassword')
                        <div id="newPasswordError" class="invalid-feedback text-start">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="mb-3 row">
                <label for="newPasswordCheck" class="col-sm-3 col-form-label required-label">Kontrola hesla</label>
                <div class="col-sm-9">
                    <input type="password" class="form-control @error('newPasswordCheck') is-invalid @enderror" id="newPasswordCheck" name="newPasswordCheck" aria-describedby="newPasswordCheckError">
                    @error('newPasswordCheck')
                        <div id="newPasswordCheckError" class="invalid-feedback text-start">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Změnit</button>
        </form>
    </x-card>

    <x-card>
        <x-slot:title>
            Kurzy, ve kterých uživatel je studentem
        </x-slot:title>

        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col">Zkratka</th>
                <th scope="col">Název</th>
                <th scope="col">Hodnocení</th>
                <th scope="col">Registrace</th>
                <th></th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @forelse($student_courses as $course)
                <tr>
                    <td class="bold"><a href="{{ route('course-detail', $course->id) }}">{{ $course->shortcut }}</a></td>
                    <td>{{ $course->name }}</td>
                    <td>{{ !$course->total_score ? '-': ($course->total_score > 100 ? '100' : $course->total_score) }} / 100</td>
                    <td>{{ $course->registered_at }}</td>
                    <td class="fit">
                        <a href="{{ route('course-edit', ['courseId' => $course->id]) }}"><x-go-info-16 class="text-primary"/></a>
                    </td>
                    <td class="fit">
                        <button type="button" class="btn btn-link" onclick="showToast('confirmationStudentToast', {{ $course->studentCourseID }})">
                            <x-go-circle-x-fill-16 class="text-danger"/>
                        </button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">Nejsou nalezené žadné kurzy</td>
                </tr>
            @endforelse
            </tbody>
        </table>
        <form action="{{ route('admin-person-add-student-course', $person->id) }}" class="add-teacher-select">
            <div class="input-group mb-3">
                <select id="student_course" name="student_course" class="form-control">
                    <option>Nevybráno</option>
                    @foreach($student_courses_add as $course)
                    <option value="{{ $course->id }}"><span class="fw-bold">{{ $course->shortcut }}</span> - {{ $course->name }}</option>
                    @endforeach
                </select>
                <button type="submit" class="btn btn-outline-secondary" id="button-addon2">Přidat</button>
            </div>
        </form>
    </x-card>

    <x-card>
        <x-slot:title>
            Kurzy, ve kterých uživatel je učitelem
        </x-slot:title>

        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col">Zkratka</th>
                <th scope="col">Název</th>
                <th scope="col">Registrace</th>
                <th scope="col">Garant</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @forelse($teacher_courses as $course)
                <tr>
                    <td class="bold"><a href="{{ route('course-detail', $course->id) }}">{{ $course->shortcut }}</a></td>
                    <td>{{ $course->name }}</td>
                    <td>{{ $course->registered_at }}</td>
                    <td class="fit text-center">
                        @if ($course->guarantorID == $person->id)
                            <x-go-check-circle-fill-16 class="text-success" />
                        @endif
                    </td>
                    <td class="fit">
                        <button type="button" class="btn btn-link" onclick="showToast('confirmationTeacherToast', {{ $course->teacherCourseID }})">
                            <x-go-circle-x-fill-16 class="text-danger"/>
                        </button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">Nejsou nalezené žadné kurzy</td>
                </tr>
            @endforelse
            </tbody>
        </table>
        <form action="{{ route('admin-person-add-teacher-course', $person->id) }}" class="add-teacher-select">
            <div class="input-group mb-3">
                <select id="teacher_course" name="teacher_course" class="form-control">
                    <option>Nevybráno</option>
                    @foreach($teacher_courses_add as $course)
                        <option value="{{ $course->id }}"><span class="fw-bold">{{ $course->shortcut }}</span> - {{ $course->name }}</option>
                    @endforeach
                </select>
                <button type="submit" class="btn btn-outline-secondary" id="button-addon2">Přidat</button>
            </div>
        </form>
    </x-card>
    <div id="confirmationTeacherToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-body">
            Opravdu chcete tento kurz odebrat?
            <div class="mt-2 pt-2 border-top toast-buttons">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="toast">Ne</button>
                <form class="form-hidden" action="{{ route('admin-person-del-teacher-course') }}" method="get">
                    @csrf
                    <input type="hidden" id="confirmationTeacherToastID" name="id" />
                    <button type="submit" class="btn btn-danger">Ano</button>
                </form>
            </div>
        </div>
    </div>
    <div id="confirmationStudentToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-body">
            Opravdu chcete tento kurz odebrat?
            <div class="mt-2 pt-2 border-top toast-buttons">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="toast">Ne</button>
                <form class="form-hidden" action="{{ route('admin-person-del-student-course') }}" method="get">
                    @csrf
                    <input type="hidden" id="confirmationStudentToastID" name="id" />
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
