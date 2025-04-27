<div>
    @section('title', 'Subject')

    @include('livewire.admin.subject.subject-modal')
            <!-- Modal -->

                <div class="main-content">
                    <section class="section">
                      <div class="section-body">
                        <div class="row">
                            <div class="col-md-12">
                                @if (session('success'))
                                <div class="alert alert-success">{{ session('success') }}</div>
                            @endif
                            </div>
                            <div class="col-12">
                              <div class="card">
                                <div class="card-header">
                                    <div class="w-100">
                                        <h4 style="float: left; width:50%; display:inline;">Subject Details</h4>
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
                                          <th>Class</th>
                                          <th>Name</th>
                                          <th>Code</th>
                                          <th>Status</th>
                                          <th>Action</th>
                                        </tr>
                                      </thead>
                                     <tbody>
                                        @forelse ($subjects as $value)
                                            <tr>
                                                <td>{{$value->class->name}}</td>
                                                <td>{{$value->name}}</td>
                                                <td>{{$value->code}}</td>
                                                <td>{{$value->status == '1' ? 'hidden' : 'visible'}}</td>
                                                <td>
                                                    <a href="#" wire:click='editSubject({{ $value->id }})' class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#editModal">Edit</a>
                                                    <a href="#"  wire:click='deleteSubject({{ $value->id }})' class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">Del</a>
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
            @endpush

    </div>
