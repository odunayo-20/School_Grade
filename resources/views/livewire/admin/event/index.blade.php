<div>
    <!-- Main Content start -->
    <div class="main-content">
        @include('livewire.admin.deleteForm.delete-form')
        <!-- section start -->
        <section class="section">
          <div class="section-body">
            <!-- add content start here -->

            <div class="row">
            <div class="my-2 col-12">
                          <a href="{{ route('admin_event_create') }}" class="btn btn-primary" style="float: right;">Add Event</a>
                      </div>

              <div class="col-12">

                <div class="card">
                  <div class="card-header">

                    <h4>Event Record Table</h4>

                     <div class="card-header-form">
                        <div class="row g-3 align-items-center">
                            <div class="col-auto">
                                <div class="input-group">
                                    <input wire:model.live='search' type="search" class="form-control"
                                        placeholder="Search">
                                    <div class="input-group-btn">
                                        <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-auto">
                                <select wire:model.live='pagination' class="form-select ">
                                    <option value="5">5</option>
                                    <option value="10">10</option>
                                    <option value="20">20</option>
                                    <option value="50">50</option>
                                    <option value="100">100</option>
                                </select>
                            </div>

                        </div>
                    </div>
                  </div>
                  <!-- <div class="p-0 card-body"> -->

                  <!-- query to check for staff count stop -->
                  <div class="row">
                    <div class="col-12">
                      <div class="mb-0 card">
                        <div class="card-body">
                          <ul class="nav nav-pills">
                            <li class="nav-item">
                              <a class="nav-link active" href="#">All <span class="badge badge-white">{{ count($events) }}</span></a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link" href="#">Publish <span class="badge badge-primary">{{ count($eventsPublish) }}</span></a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link" href="#">Draft <span class="badge badge-primary">{{ count($eventsDraft) }}</span></a>
                            </li>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>


                  <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    <div class="table-responsive">
                      <table id="mainTable" class="table table-striped">
                        <tr>
                          <th>S/N</th>
                          <th>Title</th>
                          <th>Image</th>
                          <th>Status</th>
                          <th>Date</th>
                          <th>Time</th>
                          <th>Action</th>
                        </tr>

                        @foreach ($events as $event)
                            <tr>
                                <td>{{$loop->index+1}}</td>
                                <td>{{ Str::limit($event->title, 30, '...')  }}</td>
                                <td><img class="img-fluid rounded-circle " style='height:50px; width:50px' src="{{ Storage::url($event->image) }}" alt="" srcset=""></td>
                                <td><button
                                    class="btn btn-sm btn-dange {{ $event->status == '1' ? '0' : 'btn-success' }} {{ $event->status == '0' ? '1' : 'btn-danger' }}"
                                    wire:click="updateStatus({{ $event->id }}, '{{ $event->status == '0' ? '1' : '0' }}')">
                                    @if ($event->status == '0')
                                    {{ 'Active' }}
                                    @else
                                    {{ 'Inactive' }}
                                    @endif
                                </button></td>
                    <td>{{ $event->date }}</td>
                                <td>{{ $event->time }}</td>
                                <td>
                                    <a href="{{ url('admin/event/view/'.$event->slug) }}" class="btn btn-sm btn-warning"><i
                                        class="fa fa-eye"></i></a>
                                    <a href="{{ url('admin/event/edit/'.$event->slug) }}" class="btn btn-sm btn-primary"><i
                                        class="fa fa-pen"></i></a>

                                    <a href="#" wire:click='delete({{ $event->id }})' data-bs-toggle="modal" data-bs-target="#deleteModal" class="btn btn-sm btn-danger"><i
                                        class="fa fa-trash"></i></a>
                                </td>
                            </tr>
                        @endforeach


                      </table>

                      {{ $events->links() }}


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
      </div>
      @push('script')
      <script>

          window.addEventListener('close-modal', event => {
              $('#deleteModal').modal('hide');
          });
          </script>
      @endpush
