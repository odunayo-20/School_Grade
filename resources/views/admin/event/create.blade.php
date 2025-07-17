@extends('layouts.admin-app')

@section('content')
    <!-- Main Content start -->
    <div class="main-content">
        <section class="section">
            <div class="section-body">
                <!-- Form Card Start -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Write Your Event Post</h4>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('admin_event_store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf

                                    <!-- Title -->
                                    <div class="mb-4 form-group row">
                                        <label class="col-form-label col-md-12">Title</label>
                                        <div class="col-md-12">
                                            <input name="title" type="text" class="form-control"
                                                value="{{ old('title') }}">
                                            @error('title')
                                                <span class="mt-1 text-danger d-block">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Image -->
                                    <div class="mb-4 form-group row">
                                        <label class="col-form-label col-md-12">Image</label>
                                        <div class="col-sm-12 col-md-12">
                                            <input name="image" type="file" class="form-control">
                                            @error('image')
                                                <span class="mt-1 text-danger d-block">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Date -->
                                    <div class="mb-4 form-group row">
                                        <label class="col-form-label col-md-12">Date</label>
                                        <div class="col-sm-12 col-md-12">
                                            <input name="date" type="date" class="form-control"
                                                value="{{ old('date') }}">
                                            @error('date')
                                                <span class="mt-1 text-danger d-block">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Time -->
                                    <div class="mb-4 form-group row">
                                        <label class="col-form-label col-md-12">Time</label>
                                        <div class="col-sm-12 col-md-12">
                                            <input name="time" type="time" class="form-control"
                                                value="{{ old('time') }}">
                                            @error('time')
                                                <span class="mt-1 text-danger d-block">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Location -->
                                    <div class="mb-4 form-group row">
                                        <label
                                            class="col-form-label col-md-12">Location</label>
                                        <div class="col-sm-12 col-md-12">
                                            <input name="location" type="text" class="form-control"
                                                value="{{ old('location') }}">
                                            @error('location')
                                                <span class="mt-1 text-danger d-block">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Message -->
                                    <div class="mb-4 form-group row">
                                        <label class="col-form-label col-md-12">Message</label>
                                        <div class="col-sm-12 col-md-12">
                                            <textarea name="message" id="summernote" class="form-control" rows="10">{{ old('message') }}</textarea>
                                            @error('message')
                                                <span class="mt-1 text-danger d-block">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Submit Button -->
                                    <div class="mb-4 form-group row">
                                        <div class="col-sm-12 offset-md-3 col-md-12">
                                            <button type="submit" class="btn btn-primary">Create Post</button>
                                        </div>
                                    </div>
                                </form>
                            </div> <!-- card-body -->
                        </div> <!-- card -->
                    </div> <!-- col -->
                </div> <!-- row -->
                <!-- Form Card End -->
            </div>
        </section>
    </div>
    <!-- Main Content end -->
@endsection


@section('scripts')
    <!-- Summernote CSS & JS -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#summernote').summernote({
                height: 300,
                dialogsInBody: true, // <-- critical
                dialogsFade: true // nice little UX touch (optional)
            });
        });
    </script>
@endsection
