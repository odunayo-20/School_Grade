@extends('Layouts.auth-layout')

@section('title', 'Student')

@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-body">
                <div class="row">
                    <div class="col-12 col-md-12 col-lg-12">
                        <div class="card">
                            <form action="{{ route('admin.student.update', $student->id) }}" method="POST" enctype="multipart/form-data">
                                {{-- @method('PUT') --}}
                                @csrf
                                <div class="card-header">
                                    <div class="w-100">
                                        <h4 style="float: left; width:50%; display:inline;">Circular Edit</h4>
                                        <h4 style="float: right; width:50%; display:inline; text-align: right" >
                                            <a href="{{route('admin.student')}}" class="btn btn-danger">Back</a>
                                        </h4>
                                    </div>

                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Title</label>
                                                <input type="text" name="title" class="form-control">
                                                @error('title')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">


                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Session</label>
                                                <select name="schoolsession_id" id="" class="form-select">
                                                    <option value="">--Select Academic session--</option>
                                                    @foreach ($sessions as $value)
                                                        <option value="{{ $value->id }}">{{ $value->name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('schoolsession_id')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Session</label>
                                                <select name="semester_id" id="" class="form-select">
                                                    <option value="">--Select Term--</option>
                                                    @foreach ($semesters as $value)
                                                        <option value="{{ $value->id }}">{{ $value->name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('semester_id')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>File</label>
                                                <input type="file" value="{{old('attachment')}}" name="attachment" class="form-control">
                                                @error('attachment')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>circular date</label>
                                                <input type="date" value="{{old('circular_date')}}" name="circular_date" class="form-control">
                                                @error('circular_date')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                    </div>

                                  <div class="row">
                                    <textarea name="message" id="message" cols="30" rows="10"></textarea>
                                  </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Status</label>
                                            <input type="checkbox" value="{{old('status')}}" name="status"
                                                class="form-input-check form-input-check-lg">
                                        </div>
                                    </div>

                                </div>

                                <div class="text-right card-footer">
                                    <button class="btn btn-primary">Submit</button>
                                </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
    </div>
    </section>
    </div>
@endsection
