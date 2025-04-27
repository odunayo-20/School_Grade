<div>

<style>
    th, td{
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
                                $subjectTotal = $this->calculateTotalMarks($student->id, $subject->id);
                                $totalPercentage += $subjectTotal;

                                $firstSemTotal = 0;
                                $secondSemTotal = 20;
                                // If Semester 3 is selected, fetch marks directly from the database
                                if ($selectedSemester == 3) {
                                    $firstSemTotal = \App\Models\Result::where('student_id', $student->id)
                                        ->where('subject_id', $subject->id)
                                        ->where('semester_id', 1)
                                        ->where('schoolsession_id', $selectedSession)
                                        ->sum('marks');

                                    $secondSemTotal = \App\Models\Result::where('student_id', $student->id)
                                        ->where('subject_id', $subject->id)
                                        ->where('semester_id', 2)
                                        ->where('schoolsession_id', $selectedSession)
                                        ->sum('marks');
                                    $thirdSemTotal = \App\Models\Result::where('student_id', $student->id)
                                        ->where('subject_id', $subject->id)
                                        ->where('semester_id', 3)
                                        ->where('schoolsession_id', $selectedSession)
                                        ->sum('marks');

                                    $overallTotal = $firstSemTotal + $secondSemTotal + $subjectTotal;
                                }
                            @endphp
                            {{-- <td>{{ number_format($subjectTotal, 2) }}%</td> --}}

                            @if ($selectedSemester == 3)
                                {{-- <td><strong>{{ $firstSemTotal }}%</strong></td>
                            <td><strong>{{ $secondSemTotal }}%</strong></td>
                            <td><strong>{{ number_format($overallTotal, 2) }}%</strong></td> --}}
                            @endif

                            @php
                                $overallAverage = $subjectCount > 0 ? $totalPercentage / $subjectCount : 0;
                            @endphp



                            <td>
                                @php
                                    // Get marks by category for this student and subject
                                    $classWork = $results
                                        ->where('student_id', $student->id)
                                        ->where('subject_id', $subject->id)
                                        ->where('type', 'Class Work')
                                        ->sum('marks');

                                    $homeWork = $results
                                        ->where('student_id', $student->id)
                                        ->where('subject_id', $subject->id)
                                        ->where('type', 'Home Work')
                                        ->sum('marks');

                                    $testWork = $results
                                        ->where('student_id', $student->id)
                                        ->where('subject_id', $subject->id)
                                        ->where('type', 'Test Work')
                                        ->sum('marks');

                                    $exam = $results
                                        ->where('student_id', $student->id)
                                        ->where('subject_id', $subject->id)
                                        ->where('type', 'Exam')
                                        ->sum('marks');

                                    // Assume maximum possible marks for each category
                                    $maxClassWork = 10;
                                    $maxHomeWork = 10;
                                    $maxTestWork = 20;
                                    $maxExam = 60;

                                    // Calculate weighted percentage for this subject
                                    $subjectPercentage =
                                        ($classWork / $maxClassWork) * 10 +
                                        ($homeWork / $maxHomeWork) * 10 +
                                        ($testWork / $maxTestWork) * 20 +
                                        ($exam / $maxExam) * 60;

                                    // Accumulate total for overall percentage calculation
                                    $totalPercentage += $subjectPercentage;
                                    $subjectCount++;
                                @endphp

                                <div><strong>Class Work:</strong> {{ $classWork }}/10</div>
                                <div><strong>Home Work:</strong> {{ $homeWork }}/10</div>
                                <div><strong>Test Work:</strong> {{ $testWork }}/20</div>




                                {{-- <div><strong>Exam:</strong> {{ number_format($subjectTotal, 2) }}%</div> --}}
                                <div><strong>Exam:</strong> {{ $exam }}/60</div>
                                @if ($selectedSemester == 3)
                                    <div><strong>First semester:</strong> {{ number_format($firstSemTotal, 2) }}%</div>
                                    <div><strong>Second semester:</strong> {{ number_format($secondSemTotal, 2) }}%
                                    </div>
                                    <div><strong>Third semester:</strong> {{ number_format($thirdSemTotal, 2) }}%</div>
                                    @php
                                        $result = $firstSemTotal + $secondSemTotal + $thirdSemTotal;
                                        $totalResult = $result / 3;
                                    @endphp
                                    <div><strong>Subject Total:</strong> {{ number_format($totalResult, 2) }}%</div>
                                @else
                                    <div><strong>Subject Total:</strong> {{ number_format($subjectPercentage , 2) }}%
                                    </div>
                                @endif

                                @if ($selectedSemester == 3)

                                @if ($totalResult >= 90) A+
                                @elseif ($totalResult >= 80) A
                                @elseif ($totalResult >= 70) B
                                @elseif ($totalResult >= 60) C
                                @elseif ($totalResult >= 50) D
                                @elseif ($totalResult >= 40) E
                                @else F
                                @endif

                                @else

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
