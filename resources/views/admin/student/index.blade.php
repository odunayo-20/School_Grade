@extends('Layouts.auth-layout')

@section('title', 'Student')

@section('content')
<div class="main-content">
    <section class="section">
      <div class="section-body">
        <div class="row">
            <div class="col-md-12">
                @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            </div>
              <div class="card">
                <div class="card-header">
                    <div class="w-100">
                        <h4 style="float: left; width:50%; display:inline;">Student Details</h4>
                        <h4 style="float: right; width:50%; display:inline; text-align: right" >
                            <a href="{{route('admin.student.create')}}" class="btn btn-primary">Create</a>
                        </h4>
                    </div>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-striped table-hover" id="save-stage" style="width:100%;">
                      <thead>
                        <tr>
                          <th>First Name</th>
                          <th>Last Name</th>
                          <th>Class</th>
                          <th>Registration No</th>
                          <th>Phone</th>
                          <th>Email</th>
                          <th>Status</th>
                          <th>Action</th>

                        </tr>
                      </thead>
                     <tbody>
                        @foreach ($students as $student)
<tr>
    <td>
      {{ $student->first_name }}
    </td>
    <td>
      {{ $student->last_name }}
    </td>
    <td>
      {{ $student->class->name }}
    </td>
    <td>
      {{ $student->register_number }}
    </td>
    <td>
      {{ $student->phone }}
    </td>
    <td>
{{$student->email}}
    </td>
    <td>
      {{ $student->status == 1 ? 'hidden' : 'visible' }}
    </td>
    <td>
        <a href="{{route('admin.student.edit', $student->id)}}" class="btn btn-outline-primary">Edit</a>
        <form class="d-inline" action="{{ route('admin.student.delete',$student->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this?')">
            @csrf
            @method('DELETE')
            <button class="btn btn-outline-danger" type="submit">
                <i class="fa fa-trash"></i>
                {{-- Del --}}
            </button>
        </form>
    </td>
</tr>
                        @endforeach

                     </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
      </div>
    </section>
</div>
@endsection
