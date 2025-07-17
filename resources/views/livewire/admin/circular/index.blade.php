<div class="main-content">
    @include('livewire.admin.circular.circular-modal')
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
                            <h4 style="float: left; width:50%; display:inline;">Circular Details</h4>
                            <h4 style="float: right; width:50%; display:inline; text-align: right">
                                <a href="{{ route('admin.circular.create') }}" class="btn btn-primary">Create</a>
                            </h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover" id="save-stage" style="width:100%;">
                                <thead>
                                    <tr>
                                        <th>Academic Session</th>
                                        <th>Semester</th>
                                        <th>Title</th>
                                        <th>Status</th>
                                        <th>Action</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($circulars as $value)
                                    <tr>
                                        <td>{{ $value->session->name }}</td>
                                        <td>{{ $value->semester->name }}</td>
                                        <td>{{ Str::title(Str::words($value->title, 4)) }}</td>

                                        <td>{{ $value->status == '1' ? 'hidden' : 'visible' }}</td>
                                        <td>
                                            <button wire:click="downloadPdf({{ $value->id }})"
                                                class="btn btn-sm btn-primary">
                                                Download PDF
                                            </button>
                                            <a href="{{ route('admin.circular.show', $value->id) }}"
                                                class="btn btn-sm btn-primary">Show</a>
                                            <a href="#" wire:click='deleteCircular({{ $value->id }})'
                                                class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                                data-bs-target="#deleteModal">Del</a>
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

    </section>


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