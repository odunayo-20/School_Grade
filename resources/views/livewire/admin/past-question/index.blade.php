<div>
    @section('title', 'Past Questions')

    @include('livewire.admin.past-question.past-question-modal')
            <!-- Modal -->
                <div class="main-content">
                    <section class="section">
                      <div class="section-body">
                        <div class="row">
                            <div class="col-md-12">
                                @if (session('success'))
                                <div class="alert alert-success">{{ session('success') }}</div>
                            @endif
                                @if (session('error'))
                                <div class="alert alert-danger">{{ session('error') }}</div>
                            @endif
                            </div>
                            <div class="col-12">
                              <div class="card">
                                <div class="card-header">
                                    <div class="w-100">
                                        <h4 style="float: left; width:50%; display:inline;">Past Question Details</h4>
                                        <h4 style="float: right; width:50%; display:inline; text-align: right" >
                                            <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModal">Create</a>
                                        </h4>
                                    </div>

                                </div>
                                <div class="card-body">
                                  <div class="table-responsive">
                                    <table class="table table-striped table-hover" id="save-stage" style="width:100%;">
                                      <thead>
                                        <tr>
                                          <th>Title</th>
                                          <th>Class</th>
                                          <th>Subject</th>
                                          <th>Term</th>
                                          <th>Session</th>
                                          <th>Action</th>
                                        </tr>
                                      </thead>
                                     <tbody>
                                        @forelse ($pastQuestions as $value)
                                            <tr>
                                                <td> {{ Str::title(Str::words($value->title, 4)) }}</td>
                                                <td>{{$value->class->name}}</td>
                                                <td>{{$value->subject->name}}</td>
                                                <td>{{$value->term->name}}</td>
                                                <td>{{$value->session->name}}</td>
                                                <td>
                                                    <a href="#" wire:click.prevent="downloadPast({{ $value->id }})" class="btn btn-sm btn-primary">
                                                        Download
                                                    </a>

                                                    <a href="#" wire:click='editPast({{ $value->id }})' class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#editModal">Edit</a>
                                                    <a href="#"  wire:click='deletePast({{ $value->id }})' class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">Del</a>
                                                </td>
                                            </tr>
                                        @empty

                                        @endforelse
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
            </div>

            @push('script')
            <script>

                window.addEventListener('close-modal', event => {
                    $('#createModal').modal('hide');
                    $('#editModal').modal('hide');
                    $('#deleteModal').modal('hide');
                });
                </script>

<script>
    window.addEventListener('download-past-question', event => {
        const url = event.detail.url;
        window.open(url, '_blank'); // open in new tab or start download
    });
</script>

            @endpush

    </div>
