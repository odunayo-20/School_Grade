@extends('layouts.admin-app')

@section('content')
    <div class="main-content">
        <!-- section start -->
        <section class="section">
            <div class="section-body">
                <!-- add content start here -->

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Write Your News Post</h4>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('admin_news_store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="mb-4 form-group row">
                                        <label class="col-form-label col-md-12">Title</label>
                                        <div class="col-md-12">
                                            <input name='title' type="text" class="form-control">
                                            @error('title')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="mb-4 form-group row">
                                        <label class="col-form-label col-md-12">Subtitle</label>
                                        <div class="col-md-12">
                                            <input name='subtitle' type="text" class="form-control">
                                            @error('subtitle')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="mb-4 form-group row">
                                        <label class="col-form-label col-md-12">Summary in sentence</label>
                                        <div class="col-md-12">
                                            <input name='summary' type="text" class="form-control">
                                            @error('summary')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="mb-4 form-group row">
                                        <label class="col-form-label col-md-12">Image</label>
                                        <div class="col-md-12">
                                            <input name='image' type="file" class="form-control">
                                            @error('image')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                    </div>


                                    <div class="mb-4 form-group row">
                                        <label class="col-form-label col-md-12">Date</label>
                                        <div class="col-md-12">
                                            <input name='date' type="date" class="form-control">
                                            @error('date')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror

                                        </div>
                                    </div>
                                    <div class="mb-4 form-group row">
                                        <label class="col-form-label col-md-12">Time</label>
                                        <div class="col-md-12">
                                            <input name='time' type="time" class="form-control">
                                            @error('time')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror

                                        </div>
                                    </div>

                                    <div class="mb-4 form-group row">
                                        <label class="col-form-label col-md-12">Content</label>
                                        <div class="col-md-12">
                                            <textarea id="editor" rows="10" name='content' class="form-control"></textarea>
                                            @error('content')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror

                                        </div>
                                    </div>

                                    <div class="mb-4 form-group row">

                                        <div class="col-md-12">
                                            <button class="btn btn-primary">Create Post</button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>


                </div>
            </div>

            <!-- add content stop here-->
    </div>

    </section>
    <!-- section stop -->

    </div>
    <!-- Main content stop -->
@endsection

@section('scripts')
<!-- CSRF Token for JS -->
<meta name="csrf-token" content="{{ csrf_token() }}">


       <script>
        CKEDITOR.ClassicEditor.create(document.querySelector('#editor'), {
            toolbar: {
                items: [
                    'undo', 'redo', '|',
                    'heading', '|',
                    'bold', 'italic', 'underline', 'strikethrough', '|',
                    'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor', '|',
                    'alignment', '|',
                    'link', 'blockQuote', 'code', 'codeBlock', '|',
                    'bulletedList', 'numberedList', 'todoList', '|',
                    'outdent', 'indent', '|',
                    'imageUpload', 'insertTable', 'mediaEmbed', 'horizontalLine', '|',
                    'removeFormat', 'sourceEditing'
                ],
                shouldNotGroupWhenFull: true
            },
            heading: {
                options: [
                    { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                    { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
                    { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' }
                ]
            },
            placeholder: 'Start writing your amazing content here...',
            fontFamily: {
                options: [
                    'default', 'Arial, Helvetica, sans-serif', 'Courier New, Courier, monospace',
                    'Georgia, serif', 'Lucida Sans Unicode, Lucida Grande, sans-serif',
                    'Tahoma, Geneva, sans-serif', 'Times New Roman, Times, serif',
                    'Trebuchet MS, Helvetica, sans-serif', 'Verdana, Geneva, sans-serif'
                ],
                supportAllValues: true
            },
            fontSize: {
                options: [9, 11, 13, 'default', 17, 19, 21],
                supportAllValues: true
            },
            htmlSupport: {
                allow: [
                    {
                        name: /.*/,
                        attributes: true,
                        classes: true,
                        styles: true
                    }
                ]
            },
            image: {
                resizeUnit: '%',
                resizeOptions: [
                    { name: 'resizeImage:original', label: 'Original', value: null },
                    { name: 'resizeImage:50', label: '50%', value: '50' },
                    { name: 'resizeImage:75', label: '75%', value: '75' }
                ],
                toolbar: [
                    'imageTextAlternative', 'toggleImageCaption', 'imageStyle:inline',
                    'imageStyle:block', 'imageStyle:side', 'linkImage'
                ]
            },
            removePlugins: [
                'Markdown', 'CKBox', 'CKFinderUploadAdapter', 'EasyImage', 'RealTimeCollaborativeComments',
                'RealTimeCollaborativeTrackChanges', 'RealTimeCollaborativeRevisionHistory', 'PresenceList',
                'Comments', 'TrackChanges', 'TrackChangesData', 'RevisionHistory', 'Pagination', 'WProofreader',
                'MathType'
            ]
        });
    </script>
@endsection
