<div>

    <style>
        th,
        td {
            font-size: 12px;
        }
    </style>

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
                    <option value="">Select Semester</option>
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
                <button type="reset" class="btn btn-danger">Reset</button>
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
                    {{-- <th>Overall Average</th> --}}
                    {{-- <th>Final Grade</th> --}}
                    {{-- @if ($selectedSemester == 3)
                        <th>Total (1st + 2nd + 3rd)</th>
                    @endif --}}
                    @if ($selectedSemester == 3)
                        <th>Promotion Status</th>
                    @endif
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($students as $student)
                    <tr>
                        <td>{{ $student->first_name }} {{ $student->last_name }}</td>

                        @php
                            $totalPercentage = 0;
                            $subjectCount = 0;
                        @endphp

                        @foreach ($subjects as $subject)
                        @php
                        // Calculate total marks for this subject
                        $CA = $results->where('student_id', $student->id)->where('subject_id', $subject->id)->where('type', 'CA')->sum('marks');
                        $exam = $results->where('student_id', $student->id)->where('subject_id', $subject->id)->where('type', 'Exam')->sum('marks');

                        // Calculate weighted percentage
                        $subjectPercentage = 0;
                        if ($CA + $exam > 0) {
                            $subjectPercentage =
                                ($CA/ 40) * 40 +
                                ($exam / 60) * 60;
                        }

                        $totalPercentage += $subjectPercentage;
                        $subjectCount++;
                    @endphp

                    <td>

                        <div><strong>CA:</strong> {{ $CA }}/40</div>
                        <div><strong>Exam:</strong> {{ $exam }}/60</div>

                        @if ($selectedSemester == 3)
                            @php
                                $firstSem = \App\Models\Result::where('student_id', $student->id)->where('subject_id', $subject->id)->where('semester_id', 1)->where('schoolsession_id', $selectedSession)->sum('marks');
                                $secondSem = \App\Models\Result::where('student_id', $student->id)->where('subject_id', $subject->id)->where('semester_id', 2)->where('schoolsession_id', $selectedSession)->sum('marks');
                                $thirdSem = $exam + $CA;

                                $finalTotal = $firstSem + $secondSem + $thirdSem;
                                $finalAverage = $finalTotal / 3;
                            @endphp
                            <div><strong>1st Sem:</strong> {{ number_format($firstSem, 2) }}</div>
                            <div><strong>2nd Sem:</strong> {{ number_format($secondSem, 2) }}</div>
                            <div><strong>3rd Sem:</strong> {{ number_format($thirdSem, 2) }}</div>
                            <div><strong>Total Avg:</strong> {{ number_format($finalAverage, 2) }}%</div>
                            <div><strong>Grade:</strong> {{ $this->calculateGrade($finalAverage) }}</div>
                        @elseif ($selectedSemester == 2)
                            @php
                                $firstSem = \App\Models\Result::where('student_id', $student->id)->where('subject_id', $subject->id)->where('semester_id', 1)->where('schoolsession_id', $selectedSession)->sum('marks');
                                $secondSem = $exam + $CA;

                                $finalAverage = ($firstSem + $secondSem) / 2;
                            @endphp
                            <div><strong>1st Sem:</strong> {{ number_format($firstSem, 2) }}</div>
                            <div><strong>2nd Sem:</strong> {{ number_format($secondSem, 2) }}</div>
                            <div><strong>Total Avg:</strong> {{ number_format($finalAverage, 2) }}%</div>
                            <div><strong>Grade:</strong> {{ $this->calculateGrade($finalAverage) }}</div>
                        @else
                            <div><strong>Total Avg:</strong> {{ number_format($subjectPercentage, 2) }}%</div>
                            <div><strong>Grade:</strong> {{ $this->calculateGrade($subjectPercentage) }}</div>
                        @endif
                    </td>

                        @endforeach

                        @php
                            // Calculate final average percentage
                            $overallAverage = $subjectCount > 0 ? $totalPercentage / $subjectCount : 0;
                        @endphp

                        {{-- <td><strong>{{ number_format($overallAverage, 2) }}%</strong></td>
                        <td><strong>{{ $this->calculateGrade($overallAverage) }}</strong></td> --}}
                        @if ($selectedSemester == 3)
                            <td><strong>{{ $this->determinePromotion($overallAverage) }}</strong></td>
                            {{-- @elseif ($selectedSemester == 2)
                         <td><strong>{{ $this->determinePromotion($overallAverage) }}</strong></td> --}}
                        @endif
                        <td>
                            <button type="button" class="btn btn-sm btn-success"
                                wire:click="generatePDF({{ $student->id }})">
                                Download PDF
                            </button>
                        </td>

                    </tr>
                @endforeach

            </tbody>


        </table>
    @endif
</div>
