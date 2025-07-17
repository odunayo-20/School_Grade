<div>
    <form wire:submit.prevent="filterStudents">
        <div class="mb-3 row">
            <div class="col-md-3">
                <select wire:model="selectedClass" class="form-select">
                    <option value="">Select Class</option>
                    @foreach ($classes as $class)
                        <option value="{{ $class->id }}">{{ $class->name }}</option>
                    @endforeach
                </select>
                @error('selectedClass') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <div class="col-md-3">
                <select wire:model="selectedSession" class="form-select">
                    <option value="">Select Session</option>
                    @foreach ($sessions as $session)
                        <option value="{{ $session->id }}">{{ $session->name }}</option>
                    @endforeach
                </select>
                @error('selectedSession') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <div class="col-md-3">
                <select wire:model="selectedSemester" class="form-select">
                    <option value="">Select Semester</option>
                    @foreach ($semesters as $semester)
                        <option value="{{ $semester->id }}">{{ $semester->name }}</option>
                    @endforeach
                </select>
                @error('selectedSemester') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <div class="col-md-3">
                <button type="submit" class="btn btn-primary">Search</button>
                <button type="reset" class="btn btn-danger" wire:click="resetFields">Reset</button>
            </div>
        </div>
    </form>

    @if (count($students) > 0)
        <h3>Results:</h3>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Student Name</th>
                    @foreach (['Punctuality', 'Perseverance', 'Responsibility', 'Diligence', 'Self Control', 'Neatness', 'Honesty', 'Reliability', 'Attendance', 'Initiative', 'Organization Ability', 'Attentiveness', 'Co-operativeness', 'Curiosity', 'Creativity'] as $workType)
                        <th>{{ $workType }}</th>
                    @endforeach
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($students as $student)
                    <tr>
                        <td>{{ $student->firstname }} {{ $student->lastname }}</td>

                        @foreach (['Punctuality', 'Perseverance', 'Responsibility', 'Diligence', 'Self Control', 'Neatness', 'Honesty', 'Reliability', 'Attendance', 'Initiative', 'Organization Ability', 'Attentiveness', 'Co-operativeness', 'Curiosity', 'Creativity'] as $workType)
                            <td>
                                <input type="text" style="width: 100px;" placeholder="Enter Marks"
                                    wire:model.defer="marks.{{ $student->id }}.{{ $workType }}"
                                    class="form-control">
                                @error("marks.{$student->id}.{$workType}")
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </td>
                        @endforeach

                        <td>
                            <button type="button" class="btn btn-primary"
                                wire:click="saveStudentMarks({{ $student->id }})">
                                Save
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-3 text-end">
            <button type="button" class="btn btn-success" wire:click="saveAllMarks">Save All</button>
        </div>
    @else
        <p class="mt-4 text-center text-muted">No students found. Please select a class and session.</p>
    @endif

    <!-- Flash Messages -->
    @if (session()->has('success'))
        <div class="mt-2 alert alert-success">{{ session('success') }}</div>
    @endif

    @if (session()->has('error'))
        <div class="mt-2 alert alert-danger">{{ session('error') }}</div>
    @endif
</div>
