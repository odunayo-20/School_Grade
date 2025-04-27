<div>
    <form wire:submit.prevent="saveResult">
        <div class="row">
            <div class="col-md-4">
                <select wire:model="student_id" class="form-select">
                    <option value="">Select Student</option>
                    @foreach($students as $student)
                        <option value="{{ $student->id }}">{{ $student->first_name }}{{ $student->last_name }}{{ $student->other_name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <select wire:model="subject_id" class="form-select">
                    <option value="">Select Subject</option>
                    @foreach($subjects as $subject)
                        <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <input type="number" class="form-control" wire:model="marks" placeholder="Enter Marks" />
            </div>
        </div>





        <button type="submit" class="btn btn-primary">Save Result</button>
    </form>

    <h3>Results:</h3>
    <table>
        <thead>
            <tr>
                <th>Student</th>
                <th>Subject</th>
                <th>Marks</th>
                <th>Grade</th>
            </tr>
        </thead>
        <tbody>
            @foreach($results as $result)
                <tr>
                    <td>{{ $result->student->first_name }}</td>
                    <td>{{ $result->subject->name }}</td>
                    <td>{{ $result->marks }}</td>
                    <td>{{ \App\Models\Grade::getGrade($result->marks)->grade }}</td>
                    <td>{{ \App\Models\Grade::getGrade($result->marks)->remark }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
