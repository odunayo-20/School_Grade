<!DOCTYPE html>
<html>

<head>
    <title>Student Result</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            height: 100%;
        }

        .pdf-table1 {
            width: 100%;
            border-collapse: collapse;
            font-size: 10px;
            /* height: 400px; */
            /* margin-top: 20px; */
        }

        .pdf-table1 th,
        .pdf-table1 td {
            border: 1px solid black;
            padding: 4px;
            text-align: center;
            font-size: 10px;
        }

        .pdf-table1 th {
            background-color: #f2f2f2;
        }

        .details-table {
            border: none;
            width: 100%;
            font-size: 12px;
        }

        .details-table th,
        .details-table td {
            border: none;
        }

        .school-details {
            text-align: center;
            font-size: 12px;
            line-height: 1;
        }

        .affective-table {
            width: 100%;
            border: 1px solid;
            font-size: 10px;
        }

        .key-table {
            width: 100%;
            border: 1px solid;
            font-size: 10px;
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
            /* margin-top: 10px;
            margin-bottom: 10px; */
            height: 300px;
            display: block;
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

        .text {
            font-size: 12px;
        }

        .signatures {
            /* background: red; */
            width: 100%;

        }


        .signature-box {
            width: 50%;
        }

        .signature-line {
            /* border-top: 1px solid black;
            width: 100%; */
        }


        .performance {
            font-size: 10px;
        }

        .performance p {
            width: 30%;
            float: left;
        }

        .text {
            display: block;
            width: 100%
        }

        .text p {
            display: inline;
            padding-left: 12px;
            padding-right: 14px;
        }

        .text h3 {
            display: block;
            font-size: 12px;
            line-height: 2;
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

    @php
    use App\Models\Result;

    // Step 1: Define semesters to include
    $relevantSemesters = $selectedSemester == 3 ? [1, 2, 3] : ($selectedSemester == 2 ? [1, 2] : [$selectedSemester]);

    // Step 2: Get total marks across all subjects and relevant semesters
    $overallResults = Result::where('schoolsession_id', $selectedSession)
        ->whereIn('semester_id', $relevantSemesters)
        ->selectRaw('student_id, SUM(marks) as total_marks')
        ->groupBy('student_id')
        ->orderByDesc('total_marks')
        ->get();

    // Step 3: Assign rankings
    $rank = 1;
    $prevScore = null;
    $positionMap = [];

    foreach ($overallResults as $index => $result) {
        if ($prevScore !== null && $result->total_marks < $prevScore) {
            $rank = $index + 1;
        }
        $positionMap[$result->student_id] = $rank;
        $prevScore = $result->total_marks;
    }

    // Step 4: Ordinal helper
    if (!function_exists('ordinal')) {
        function ordinal($number)
        {
            $suffixes = ['th', 'st', 'nd', 'rd', 'th', 'th', 'th', 'th', 'th', 'th'];
            if ($number % 100 >= 11 && $number % 100 <= 13) {
                return $number . 'th';
            }
            return $number . $suffixes[$number % 10];
        }
    }

    // Step 5: Get overall rank for the current student
    $overallRank = isset($positionMap[$student->id]) ? ordinal($positionMap[$student->id]) : 'N/A';
    @endphp

    <div class="school-details" style="font-size:bold; text-transform: uppercase;">
        <h2 style="text-align: center;">Ogo-Oluwa Group of Schools, Emure</h2>

        <p>Behind Energy Filling Station Emure Ile Junction, Owo L.G.A, ONDO STATE </p>
        <p>ogooluwagse@gmail.com, 09060036867, 08060180552, 08136089968</p>
        <p>Motto: Education For Better Future</p>
        <p style="font-size:bold; text-transform: capitalize;">{{ $semester->name }} Report</p>

    </div>
    <table class="details-table">
        <tr>
            <th>Name:</th>
            <td style="font-size:bold; text-transform: capitalize;"> {{ $student->first_name }} {{ $student->last_name }}
            </td>
            <th>Registration No:</th>
            <td style="font-size:bold; text-transform: capitalize;"> {{ $student->register_number }}</td>
            <th>Times School Opened:</th>
            <td>
                @if ($totals)
                    {{ $totals->total }}
                @endif
            </td>
        </tr>
        <tr>
            <th>Class:</th>
            <td>{{ $student->class->name }}</td>
            <th>Academic Session:</th>
            <td> {{ $student->session->name }}</td>
            <th>Times Present:</th>
            <td>
                @if ($total_attendances)
                    {{ $total_attendances->marks }}
                @endif
            </td>
        </tr>
        <tr>
            @if ($resumption == null)
            @else
                <th>Vacation Date:</th>
                <td> {{ $resumption->vacation_date }}</td>
                <th>Resumption Date:</th>
                <td> {{ $resumption->resumption_date }}</td>
            @endif
            <th>Times Absent:</th>
            <td>
                @if ($totals && $total_attendances)
                    {{ $totals->total - $total_attendances->marks }}
                @endif
            </td>
            <th>Position:</th>
            <td>
               {{ $overallRank }}
            </td>

        </tr>

    </table>

    <table class="pdf-table1">
        <thead>
            <tr>
                <th>Subject</th>
                <th>CA</th>
                <th>Exam</th>
                @if ($selectedSemester == 2)
                    <th>1st Term (100)</th>
                    <th>2nd Term (100)</th>
                    <th>Overall Total (200)</th>
                    <th>Overall Average</th>
                @elseif($selectedSemester == 3)
                    <th>1st Term (100)</th>
                    <th>2nd Term (100)</th>
                    <th>3rd Term (100)</th>
                    <th>Overall Total (300)</th>
                    <th>Overall Average</th>
                @else
                    <th>Term Total</th>
                @endif
                <th>Grade</th>
                <th>Remarks</th>
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

                    $CA = $semesterScores->where('semester_id', $selectedSemester)->where('type', 'CA')->sum('marks');
                    $exam = $semesterScores
                        ->where('semester_id', $selectedSemester)
                        ->where('type', 'Exam')
                        ->sum('marks');

                    $semesterTotal = $CA + $exam;
                    $overallTotal2 = $firstSemTotal + $secondSemTotal;
                    $overallTotal = $firstSemTotal + $secondSemTotal + $thirdSemTotal;
                    $overallAverage2 = $selectedSemester == 2 ? $overallTotal2 / 2 : $semesterTotal;
                    $overallAverage = $selectedSemester == 3 ? $overallTotal / 3 : $semesterTotal;
                @endphp


                @php
                    // Fetch all results for the selected semester and subject
                    $subjectResults = \App\Models\Result::where('subject_id', $subject->id)
                        ->where('schoolsession_id', $selectedSession)
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
                        if ($prevScore !== null && $result->total_marks < $prevScore) {
                            $rank = $index + 1;
                        }
                        $positionMap[$result->student_id] = $rank;
                        $prevScore = $result->total_marks;
                    }

                    // Check if ordinal function exists before defining it
                    if (!function_exists('ordinal')) {
                        function ordinal($number)
                        {
                            $suffixes = ['th', 'st', 'nd', 'rd', 'th', 'th', 'th', 'th', 'th', 'th'];
                            if ($number % 100 >= 11 && $number % 100 <= 13) {
                                return $number . 'th';
                            }
                            return $number . $suffixes[$number % 10];
                        }
                    } // Get current student's rank with ordinal suffix
$studentRank = isset($positionMap[$student->id]) ? ordinal($positionMap[$student->id]) : 'N/A';
                @endphp




                <tr>
                    <td style="text-transform:uppercase;">{{ $subject->name }}</td>
                    <td>{{ $CA }}</td>
                    <td>{{ $exam }}</td>

                    @if ($selectedSemester == 3)
                        <td>{{ $firstSemTotal }}</td>
                        <td>{{ $secondSemTotal }}</td>
                        <td>{{ $thirdSemTotal }}</td>
                        <td>{{ $overallTotal }}</td>
                        <td>{{ number_format($overallAverage, 2) }}</td>
                    @elseif($selectedSemester == 2)
                        <td>{{ $firstSemTotal }}</td>
                        <td>{{ $secondSemTotal }}</td>
                        <td>{{ $overallTotal2 }}</td>
                        <td>{{ number_format($overallAverage2, 2) }}</td>
                    @else
                        <td>{{ $semesterTotal }}</td>
                    @endif

                    @if ($selectedSemester == 2)
                        <td>{{ getGrade($selectedSemester == 2 ? $overallAverage2 : $semesterTotal) }}</td>
                    @elseif ($selectedSemester == 3)
                        <td>{{ getGrade($selectedSemester == 3 ? $overallAverage : $semesterTotal) }}</td>
                    @else
                        <td>{{ getGrade($selectedSemester == 1 ? $overallAverage : $semesterTotal) }}</td>
                    @endif
                    <td>
                        @if ($selectedSemester == 3)
                            {{ getRemarks($overallAverage) }}
                        @elseif ($selectedSemester == 2)
                            {{ getRemarks($overallAverage2) }}
                        @else
                            {{ getRemarks($semesterTotal) }}
                        @endif
                    </td>

                    <td>{{ $studentRank }}</td>

                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="text">

        <h3 style="margin-top:-3px;">Overall Performance</h3>
        @php

            $relevantSemesters =
                $selectedSemester == 3 ? [1, 2, 3] : ($selectedSemester == 2 ? [1, 2] : [$selectedSemester]);
            $overallTotalAllSubjects = $subjects->sum(
                fn($subject) => $results
                    ->where('subject_id', $subject->id)
                    ->where('schoolsession_id', $selectedSession)
                    ->whereIn('semester_id', $relevantSemesters)
                    ->sum('marks'),
            );

            $divisor = $selectedSemester == 3 ? 3 : ($selectedSemester == 2 ? 2 : 1);
            $overallAverageAllSubjects =
                $subjects->count() > 0 ? $overallTotalAllSubjects / ($subjects->count() * $divisor) : 0;

            $finalPromotion = $overallAverageAllSubjects >= 50 ? 'Promoted to Next Class' : 'Not Promoted';
        @endphp
{{-- @dd($overallTotalAllSubjects) --}}
        <p><strong>Overall Average:</strong> {{ number_format($overallAverageAllSubjects, 2) }}%</p>
        <p><strong>Final Grade:</strong> {{ getGrade($overallAverageAllSubjects) }}</p>
        @if ($selectedSemester == 3)
            <p><strong>Promotion Status:</strong> {{ $finalPromotion }}</p>
        @endif

    </div>

    <div class="side" style="margin-top:3px;">
        <div class="side1">
            <table class="key-table">
                <tr>
                    <th>100 - 70 = A - (Excellence)</th>
                    <th>69 - 60 = B - (Very Good)</th>
                </tr>
                <tr>
                    <th>59- 50 = C - (Good)</th>
                    <th>49 - 45 = D - (Average)</th>
                </tr>
                <tr>
                    <th>44 - 40 = E - (Fair)</th>
                    <th>39 - 00 = F - (Poor)</th>
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
            <div>_____________________________</div>
            <div style="font-size:12px;">Principal’s Signature</div>
        </div>
        <div class="signature-box">
            <div>_____________________________</div>
            <div style="font-size:12px; margin-bottom:5px;">Class Teacher Signature</div>
        </div>
        <div class="signature-bo">
            <span style="font-size:12px;">Principal’s Comment</span>
            <span>______________________________________________________________
                _____________________________________________________________________________</span>
        </div>

    </div>

    <p class="date-printed" style="font-size: 10px;">Date Printed: {{ $datePrinted }}</p>



</body>

</html>

@php
    function getGrade($score)
    {
        return match (true) {
            $score >= 70 => 'A',
            $score >= 60 => 'B',
            $score >= 50 => 'C',
            $score >= 45 => 'D',
            $score >= 40 => 'E',
            default => 'F',
        };
    }

    function getRemarks($score)
    {
        return match (true) {
            $score >= 70 => 'Excellent',
            $score >= 60 => 'Very Good',
            $score >= 50 => 'Good',
            $score >= 45 => 'Average',
            $score >= 40 => 'Fair',
            default => 'Poor',
        };
    }
@endphp
