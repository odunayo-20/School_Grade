@extends('Layouts.auth-layout')


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
                                            <input name='title' type="text" value="{{ old('title') }}" class="form-control">
                                            @error('title')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="mb-4 form-group row">
                                        <label class="col-form-label col-md-12">Subtitle</label>
                                        <div class="col-md-12">
                                            <input name='subtitle' value="{{ old('subtitle') }}" type="text" class="form-control">
                                            @error('subtitle')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="mb-4 form-group row">
                                        <label class="col-form-label col-md-12">Summary in sentence</label>
                                        <div class="col-md-12">
                                            <input name='summary' value="{{ old('summary') }}" type="text" class="form-control">
                                            @error('summary')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="mb-4 form-group row">
                                        <label class="col-form-label col-md-12">Image</label>
                                        <div class="col-md-12">
                                            <input name='image' type="file" value="{{ old('image') }}" class="form-control">
                                            @error('image')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                    </div>


                                    <div class="mb-4 form-group row">
                                        <label class="col-form-label col-md-12">Date</label>
                                        <div class="col-md-12">
                                            <input name='date' type="date" value="{{ old('date') }}" class="form-control">
                                            @error('date')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror

                                        </div>
                                    </div>
                                    <div class="mb-4 form-group row">
                                        <label class="col-form-label col-md-12">Time</label>
                                        <div class="col-md-12">
                                            <input name='time' type="time" value="{{ old('time') }}" class="form-control">
                                            @error('time')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror

                                        </div>
                                    </div>

                                    <div class="mb-4 form-group row">
                                        <label class="col-form-label col-md-12">Content</label>
                                        <div class="col-md-12">
                                            <textarea id="message" rows="10" name='content' value="{{ old('content') }}" class="form-control">{{ old('content') }}</textarea>
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

@push('script')
    <script src="{{ asset('admin/assets/tinymce/tinymce.min.js') }}" referrerpolicy="origin"></script>




    <script>
        // Get CSRF token
        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';

        // Initialize TinyMCE
        tinymce.init({
            selector: 'textarea#message',
            height: 400,
            menubar: false,
            plugins: [
                'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview',
                'anchor', 'searchreplace', 'visualblocks', 'code', 'fullscreen',
                'insertdatetime', 'media', 'table', 'help', 'wordcount'
            ],
            toolbar: 'undo redo | styles | bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media table | removeformat help',
            branding: false,
            automatic_uploads: true,
            file_picker_types: 'image',
            paste_data_images: true,

            // Content filtering
            valid_elements: 'p[style],strong,em,u,s,a[href|target],ul,ol,li,br,img[src|alt|width|height|style],table[border|style],tr,td[colspan|rowspan|style],th[colspan|rowspan|style],h1,h2,h3,h4,h5,h6,blockquote,code,pre',

            // Image upload configuration
            images_upload_handler: function(blobInfo, success, failure, progress) {
                const xhr = new XMLHttpRequest();
                xhr.withCredentials = false;
                xhr.open('POST', '/upload-tinymce-image');

                // Set timeout
                xhr.timeout = 30000;

                // Progress tracking
                xhr.upload.onprogress = function(e) {
                    if (e.lengthComputable && typeof progress === 'function') {
                        const percentComplete = (e.loaded / e.total) * 100;
                        progress(percentComplete);
                    }
                };



                xhr.onload = function() {
                    let json;

                    try {
                        if (xhr.status !== 200) {
                            failure('HTTP Error: ' + xhr.status + ' - ' + xhr.statusText);
                            return;
                        }

                        json = JSON.parse(xhr.responseText);
                        console.log('Upload response:', json);

                        if (!json || !json.location) {
                            failure('Invalid response: Missing location property');
                            return;
                        }

                        success(json.location);

                    } catch (e) {
                        console.error('JSON parse error:', e);
                        failure('Invalid JSON response: ' + xhr.responseText);
                    }
                };

                xhr.onerror = function() {
                    failure('Network error: Unable to upload image');
                };

                xhr.ontimeout = function() {
                    failure('Upload timeout: Please try again');
                };

                xhr.onabort = function() {
                    failure('Upload aborted');
                };

                // Validate file before upload
                const maxSize = 5 * 1024 * 1024; // 5MB
                const allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];

                if (blobInfo.blob().size > maxSize) {
                    failure('File too large. Maximum size is 5MB');
                    return;
                }

                if (!allowedTypes.includes(blobInfo.blob().type)) {
                    failure('Invalid file type. Please upload JPG, PNG, GIF, or WebP images');
                    return;
                }

                // Create form data
                const formData = new FormData();
                formData.append('file', blobInfo.blob(), blobInfo.filename());

                // Add CSRF token
                if (csrfToken) {
                    xhr.setRequestHeader('X-CSRF-TOKEN', csrfToken);
                }

                // Send request
                xhr.send(formData);
            },

            // File picker for additional file types
            file_picker_callback: function(callback, value, meta) {
                const input = document.createElement('input');
                input.setAttribute('type', 'file');
                input.setAttribute('accept', 'image/*');

                input.onchange = function() {
                    const file = this.files[0];
                    if (file) {
                        const reader = new FileReader();
                        reader.onload = function() {
                            callback(reader.result, {
                                alt: file.name
                            });
                        };
                        reader.readAsDataURL(file);
                    }
                };

                input.click();
            },

            // Setup callback
            setup: function(editor) {
                editor.on('init', function() {
                    console.log('TinyMCE initialized successfully');
                });

                editor.on('change', function() {
                    editor.save(); // Save to textarea
                });

                editor.on('ImageUploadError', function(e) {
                    console.error('Image upload error:', e);
                    showStatus('Image upload failed: ' + e.message, 'error');
                });

                editor.on('ImageUploadSuccess', function(e) {
                    console.log('Image uploaded successfully:', e);
                    showStatus('Image uploaded successfully', 'success');
                });
            },

            // Content style
            content_style: `
            body {
                font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
                font-size: 14px;
                line-height: 1.6;
            }
            img {
                max-width: 100%;
                height: auto;
            }
        `,

            // Paste settings
            paste_as_text: false,
            paste_auto_cleanup_on_paste: true,
            paste_remove_spans: true,
            paste_remove_styles: false,
            paste_remove_styles_if_webkit: true,
            paste_strip_class_attributes: 'all',

            // Additional settings
            resize: true,
            statusbar: true,
            elementpath: false,
            convert_urls: false,
            remove_script_host: false,
            relative_urls: false
        });

        // Form submission handler
        document.getElementById('editorForm').addEventListener('submit', function(e) {
            e.preventDefault();

            // Get editor content
            const content = tinymce.get('message').getContent();
            const title = document.getElementById('title').value;

            // Validate
            if (!title.trim()) {
                showStatus('Title is required', 'error');
                return;
            }

            if (!content.trim()) {
                showStatus('Content is required', 'error');
                return;
            }

            // Submit form data
            const formData = new FormData();
            formData.append('title', title);
            formData.append('message', content);

            fetch('/submit-form', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        showStatus('Form submitted successfully!', 'success');
                        // Reset form
                        document.getElementById('title').value = '';
                        tinymce.get('message').setContent('');
                    } else {
                        showStatus('Error: ' + (data.message || 'Unknown error'), 'error');
                    }
                })
                .catch(error => {
                    console.error('Submission error:', error);
                    showStatus('Network error: Unable to submit form', 'error');
                });
        });

        // Status message helper
        function showStatus(message, type) {
            const statusDiv = document.getElementById('status');
            statusDiv.className = type;
            statusDiv.textContent = message;

            // Auto-hide after 5 seconds
            setTimeout(() => {
                statusDiv.textContent = '';
                statusDiv.className = '';
            }, 5000);
        }

        // Clean up on page unload
        window.addEventListener('beforeunload', function() {
            tinymce.remove();
        });
    </script>
@endpush
