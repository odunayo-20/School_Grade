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
                @error('selectedClass')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-3">
                <select wire:model="selectedSession" class="form-select">
                    <option value="">Select Session</option>
                    @foreach ($sessions as $session)
                        <option value="{{ $session->id }}">{{ $session->name }}</option>
                    @endforeach
                </select>
                @error('selectedSession')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-3">
                <select wire:model="selectedSemester" class="form-select">
                    <option value="">Select Term</option>
                    @foreach ($semesters as $semester)
                        <option value="{{ $semester->id }}">{{ $semester->name }}</option>
                    @endforeach
                </select>
                @error('selectedSemester')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-3">
                <button type="submit" class="btn btn-primary">Search</button>
                <button type="reset" class="btn btn-danger" wire:click="resetFields">Reset</button>
            </div>
        </div>
    </form>

    @if ($students)
        <h3>Results:</h3>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Student Name</th>
                    @foreach ($subjects as $subject)
                        <th>{{ $subject->name }}</th>
                    @endforeach
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($students as $student)
                    <tr>
                        <td>{{ $student->first_name }} {{ $student->last_name }}</td>
                        @foreach ($subjects as $subject)
                            <td>
                                @foreach (['CA', 'Exam'] as $workType)
                                    <div style="margin-bottom: 10px;" wire:key="mark-{{ $student->id }}-{{ $subject->id }}-{{ $workType }}">
                                        {{ $workType }}
                                        <input
                                            type="number"
                                            name="marks[{{ $student->id }}][{{ $subject->id }}][{{ $workType }}]"
                                            style="width: 100px;"
                                            placeholder="Enter Marks"
                                            wire:model.defer="marks.{{ $student->id }}.{{ $subject->id }}.{{ $workType }}"
                                            class="form-control"
                                            min="0" max="100"
                                        >
                                        @error("marks.{$student->id}.{$subject->id}.{$workType}")
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                @endforeach
                            </td>
                        @endforeach
                        <td>
                            <button type="button" class="btn btn-primary" wire:click="saveStudentMarks({{ $student->id }})">
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
    @endif

    <!-- Flash Messages -->
    @if (session()->has('success'))
        <div class="mt-2 alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session()->has('error'))
        <div class="mt-2 alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
</div>
