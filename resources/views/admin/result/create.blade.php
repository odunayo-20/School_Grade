@extends('Layouts.auth-layout')

@section('title', 'Result')

@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-body">
                <div class="row">
                    <div class="col-12 col-md-12 col-lg-12">
                        <div class="card">
                            <form action="{{ route('admin.result.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="card-header">
                                    <div class="w-100">
                                        <h4 style="float: left; width:50%; display:inline;">Result</h4>
                                        <h4 style="float: right; width:50%; display:inline; text-align: right" >
                                            <a href="{{route('admin.result')}}" class="btn btn-danger">Back</a>
                                        </h4>
                                    </div>

                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Registration No</label>
                                                <input type="text" value="{{old('register_number')}}" name="register_number" class="form-control">
                                                @error('register_number')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Class</label>
                                                {{-- <input type="text" value="{{old('register_number')}}" name="register_number" class="form-control"> --}}
                                                <select name="class" id="" class="form-select">
                                                    <option value="">--Select Class--</option>
                                                    <option value="Jss1">Jss1</option>
                                                    <option value="Jss2">Jss2</option>
                                                    <option value="Jss3">Jss3</option>
                                                    <option value="SSS1">SSS1</option>
                                                    <option value="SSS2">SSS2</option>
                                                    <option value="SSS3">SSS3</option>
                                                </select>
                                                @error('class')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>First Name</label>
                                                <input type="text" value="{{old('first_name')}}" name="first_name" class="form-control">
                                                @error('first_name')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Last Name</label>
                                                <input type="text" value="{{old('last_name')}}" name="last_name" class="form-control">
                                                @error('last_name')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Other Name</label>
                                                <input type="text" value="{{old('other_name')}}" name="other_name" class="form-control">
                                                @error('other_name')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>


                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Email</label>
                                                <input type="text" value="{{old('email')}}" name="email" class="form-control">
                                                @error('email')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Phone</label>
                                                <input type="number" value="{{old('phone')}}" name="phone" class="form-control">
                                                @error('phone')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
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
@push('script')
    {{-- <script src="{{asset('admin/assets/bundles/summernote/summernote-bs4.js')}}"></script>
  <script src="{{asset('admin/assets/bundles/codemirror/lib/codemirror.js')}}"></script>
  <script src="{{asset('admin/assets/bundles/codemirror/mode/javascript/javascript.js')}}"></script>
  <script src="{{asset('admin/assets/bundles/jquery-selectric/jquery.selectric.min.js')}}"></script>
  <script src="{{asset('admin/assets/bundles/ckeditor/ckeditor.js')}}"></script>
  <!-- Page Specific JS File -->
  <script src="{{asset('admin/assets/js/page/ckeditor.js')}}"></script> --}}
@endpush
