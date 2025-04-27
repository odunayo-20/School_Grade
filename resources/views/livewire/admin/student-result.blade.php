<!DOCTYPE html>
<html>

<head>
    <title>Student Result</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .pdf-table1 {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .pdf-table1 th,
        .pdf-table1 td {
            border: 1px solid black;
            padding: 8px;
            text-align: center;
            font-size: 12px;
        }

        .pdf-table1 th {
            background-color: #f2f2f2;
        }

        .details-table {
            border: none;
            width: 100%;
            font-size: 13px;
        }

        .details-table th,
        .details-table td {
            border: none;
        }

        .school-details {
            text-align: center;
            font-size: 13px;
        }

        .affective-table {
            width: 100%;
            border: 1px solid;
            font-size: 12px;
        }

        .key-table {
            width: 100%;
            border: 1px solid;
            font-size: 12px;
        }

        .affective-table th {
            border: 1px solid;
            text-align: center;
        }

        .affective-table td {
            border: 1px solid;
            text-align: center;
        }

        .side {
            width: 100%;
            margin-top: 10px;
            margin-bottom: 10px;
        }

        .side1 {
            width: 40%;
            float: left;
            margin-right: 15px;
        }

        .side2 {
            width: 55%;
            float: right;
        }

        .text{
            font-size: 12px;
        }

        .signatures {
            margin-top: 10px;
            width: 100%
        }

        .signature-box {
            margin-top: -25px;
            margin-bottom: -25px;
        }

        .signature-line {
            border-top: 1px solid black;
            width: 40%;
        }


        .performance{
            font-size: 10px;
        }
        .performance p{
            width: 30%;
            float: left;
        }

        p{

        }
    </style>
</head>

<body>
    @php
    $semester = \App\Models\Semester::where('id', $selectedSemester)->first();
    @endphp

    @php
    $semester = \App\Models\Semester::find($selectedSemester);
    $datePrinted = now()->format('F j, Y');
@endphp
    <div class="school-details">
        <h2 style="text-align: center;">Ogo Oluwa Group of Schools, Emure</h2>

        <p>Behind Energy Filling Station Emure Ile Junction </p>
        <p style="font-size:bold; text-transform: capitalize;">{{ $semester->name }} Report</p>

    </div>
    <table class="details-table">
        <tr>
            <th>Name:</th>
            <td style="font-size:bold; text-transform: capitalize;"> {{ $student->first_name }} {{ $student->last_name }}</td>
            <th>Registration No:</th>
            <td style="font-size:bold; text-transform: capitalize;"> {{ $student->register_number }}</td>
        </tr>
        <tr>
            <th>Class:</th>
            <td>{{ $student->class->name }}</td>
            <th>Academic Session:</th>
            <td> {{ $student->session->name }}</td>

        </tr>
        <tr>
            @if ($resumption == null)

            @else
            <th>Vacation Date:</th>
            <td> {{ $resumption->vacation_date }}</td>
            <th>Resumption Date:</th>
            <td> {{ $resumption->resumption_date }}</td>

            @endif
        </tr>

    </table>

    <table class="pdf-table1">
        <thead>
            <tr>
                <th>Subject</th>
                <th>Class Work</th>
                <th>Home Work</th>
                <th>Test</th>
                <th>Exam</th>
                @if ($selectedSemester < 3) <th>Semester Total</th>
                    @else
                    <th>1st Sem (100)</th>
                    <th>2nd Sem (100)</th>
                    <th>3rd Sem (100)</th>
                    <th>Overall Total (300)</th>
                    <th>Overall Average</th>
                    @endif
                    <th>Grade</th>
                    <th>Position</th>

            </tr>
        </thead>
        <tbody>
            @foreach ($subjects as $subject)
            @php
            $semesterScores = $results->where('student_id', $student->id)->where('subject_id', $subject->id);
            $firstSemTotal = $semesterScores->where('semester_id', 1)->sum('marks');
            $secondSemTotal = $semesterScores->where('semester_id', 2)->sum('marks');
            $thirdSemTotal = $semesterScores->where('semester_id', 3)->sum('marks');

            $classWork = $semesterScores
            ->where('semester_id', $selectedSemester)
            ->where('type', 'Class Work')
            ->sum('marks');
            $homeWork = $semesterScores
            ->where('semester_id', $selectedSemester)
            ->where('type', 'Home Work')
            ->sum('marks');
            $testWork = $semesterScores
            ->where('semester_id', $selectedSemester)
            ->where('type', 'Test Work')
            ->sum('marks');
            $exam = $semesterScores
            ->where('semester_id', $selectedSemester)
            ->where('type', 'Exam')
            ->sum('marks');

            $semesterTotal = $classWork + $homeWork + $testWork + $exam;
            $overallTotal = $firstSemTotal + $secondSemTotal + $thirdSemTotal;
            $overallAverage = $selectedSemester == 3 ? $overallTotal / 3 : $semesterTotal;
            @endphp


            @php
            // Fetch all results for the selected semester and subject
            $subjectResults = \App\Models\Result::where('subject_id', $subject->id)
            ->where('semester_id', $selectedSemester)
            ->selectRaw('student_id, SUM(marks) as total_marks')
            ->groupBy('student_id')
            ->orderByDesc('total_marks')
            ->get();

            // Assign rankings
            $rank = 1;
            $prevScore = null;
            $positionMap = [];

            foreach ($subjectResults as $index => $result) {
            if ($prevScore !== null && $result->total_marks < $prevScore) { $rank=$index + 1; } $positionMap[$result->
                student_id] = $rank;
                $prevScore = $result->total_marks;
                }

                // Check if ordinal function exists before defining it
                if (!function_exists('ordinal')) {
                function ordinal($number)
                {
                $suffixes = ['th', 'st', 'nd', 'rd', 'th', 'th', 'th', 'th', 'th', 'th'];
                if ($number % 100 >= 11 && $number % 100 <= 13) { return $number . 'th' ; } return $number .
                    $suffixes[$number % 10]; } } // Get current student's rank with ordinal suffix
                    $studentRank=isset($positionMap[$student->id]) ? ordinal($positionMap[$student->id]) : 'N/A';
                    @endphp


                    <tr>
                        <td>{{ $subject->name }}</td>
                        <td>{{ $classWork }}</td>
                        <td>{{ $homeWork }}</td>
                        <td>{{ $testWork }}</td>
                        <td>{{ $exam }}</td>

                        @if ($selectedSemester < 3) <td>{{ $semesterTotal }}</td>
                            @else
                            <td>{{ $firstSemTotal }}</td>
                            <td>{{ $secondSemTotal }}</td>
                            <td>{{ $thirdSemTotal }}</td>
                            <td>{{ $overallTotal }}</td>
                            <td>{{ number_format($overallAverage, 2) }}</td>
                            @endif

                            <td>{{ getGrade($selectedSemester == 3 ? $overallAverage : $semesterTotal) }}</td>
                            <td>{{ $studentRank }}</td>

                    </tr>
                    @endforeach
        </tbody>
    </table>

    <div class="text">

        @if ($selectedSemester == 3)

            <h3>Overall Performance</h3>
            @php
    $overallTotalAllSubjects = $subjects->sum(
        fn($subject) => $results
        ->where('subject_id', $subject->id)
    ->whereIn('semester_id', [1, 2, 3])
    ->sum('marks'),
    );
    $overallAverageAllSubjects =
    $subjects->count() > 0 ? $overallTotalAllSubjects / ($subjects->count() * 3) : 0;
    $finalPromotion = $overallAverageAllSubjects >= 50 ? 'Promoted to Next Class' : 'Not Promoted';
    @endphp

    <p><strong>Overall Average:</strong> {{ number_format($overallAverageAllSubjects, 2) }}%</p>
    <p><strong>Final Grade:</strong> {{ getGrade($overallAverageAllSubjects) }}</p>
    <p><strong>Promotion Status:</strong> {{ $finalPromotion }}</p>
    @endif
</div>

    <div class="side">
        <div class="side1">
            <table class="key-table">
                <tr>
                    <th>100 - 70 = A (Excellence)</th>
                    <th>69 - 60 = B</th>
                </tr>
                <tr>
                    <th>59- 50 = C (Good)</th>
                    <th>49 - 45 = D</th>
                </tr>
                <tr>
                    <th>44 - 40 = E (Fair)</th>
                    <th>39 - 00 = F (Poor)</th>
                </tr>
            </table>
            <table class="affective-table">
                <tr>
                    <th>Pyschomotor</th>
                    <th>Grade</th>
                </tr>
                @forelse ($pyschomotors as $pyschomotor)
                <tr>
                    <td>{{ $pyschomotor->type }}</td>
                    <td>{{ $pyschomotor->marks }}</td>
                    @empty

                </tr>
                @endforelse
            </table>
        </div>
        <div class="side2">
            <table class="affective-table">
                <tr>
                    <th>Affective</th>
                    <th>Grade</th>
                </tr>
                @forelse ($affectives as $affective)
                <tr>
                    <td>{{ $affective->type }}</td>
                    <td>{{ $affective->marks }}</td>
                    @empty

                </tr>
                @endforelse
            </table>

        </div>

    </div>

    <div class="signatures">
        <div class="signature-box">
            <p>_____________________________</p>
            <p>Principal’s Signature</p>
        </div>
        <div class="signature-box">
            <p>_____________________________</p>
            <p>Guardian’s Signature</p>
        </div>
    </div>

    <p class="date-printed">Date Printed: {{ $datePrinted }}</p>

</body>

</html>

@php
function getGrade($score)
{
return match (true) {
$score >= 90 => 'A+',
$score >= 80 => 'A',
$score >= 70 => 'B',
$score >= 60 => 'C',
$score >= 50 => 'D',
$score >= 40 => 'E',
default => 'F',
};
}

@endphp
