<div>
    @section('title', 'Term')

    @include('livewire.admin.semester.semester-modal')
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
                                        <h4 style="float: left; width:50%; display:inline;">Term Details</h4>
                                        <h4 style="float: right; width:50%; display:inline; text-align: right" >
                                            <button href="#" class="btn btn-primary" disabled data-bs-toggle="modal" data-bs-target="#createModal">Create</button>
                                        </h4>
                                    </div>

                                </div>
                                <div class="card-body">
                                  <div class="table-responsive">
                                    <table class="table table-striped table-hover" id="save-stage" style="width:100%;">
                                      <thead>
                                        <tr>
                                          <th>Name</th>
                                          <th>Slug</th>
                                          <th>Status</th>
                                          <th>Action</th>
                                        </tr>
                                      </thead>
                                     <tbody>
                                        @forelse ($semesters as $value)
                                            <tr>
                                                <td>{{$value->name}}</td>
                                                <td>{{$value->slug}}</td>
                                                <td>{{$value->status == '1' ? 'hidden' : 'visible'}}</td>
                                                <td>
                                                    <button href="#" wire:click='editSemester({{ $value->id }})' class="btn btn-sm btn-primary" disabled data-bs-toggle="modal" data-bs-target="#editModal">Edit</button>
                                                    <button href="#"  wire:click='deleteSemester({{ $value->id }})' style="display: dis" class="btn btn-sm btn-danger" disabled data-bs-toggle="modal" data-bs-target="#deleteModal">Del</button>
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
