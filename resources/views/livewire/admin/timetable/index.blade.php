<div class="main-content">
    <section class="section">
      <div class="section-body">
        <div class="row">
            <div class="col-md-12">

                <div class="card">
                    <div class="card-header row-span-8">
                        <h3 class="card-title col-md-6">Manage Timetable</h3>
                        <div class="text-righ card-tools col-md-6">
                            <button wire:click="exportExcel" class="btn btn-success btn-sm">
                                <i class="fas fa-file-excel"></i> Export Excel
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <!-- Success/Error Messages -->
                        @if (session()->has('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        @if (session()->has('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        <!-- Filters -->
                        <div class="mb-3 row">
                            <div class="col-md-4">
                                <label class="form-label">Filter by Class</label>
                                <select wire:model.live="class_id" class="form-select">
                                    <option value="">All Classes</option>
                                    @foreach($classes as $class)
                                        <option value="{{ $class->id }}">{{ $class->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Filter by Day</label>
                                <select wire:model.live="day" class="form-select">
                                    <option value="">All Days</option>
                                    <option value="Monday">Monday</option>
                                    <option value="Tuesday">Tuesday</option>
                                    <option value="Wednesday">Wednesday</option>
                                    <option value="Thursday">Thursday</option>
                                    <option value="Friday">Friday</option>
                                    <option value="Saturday">Saturday</option>
                                    <option value="Sunday">Sunday</option>
                                </select>
                            </div>
                            <div class="col-md-4 d-fle align-items-end">
                                <button wire:click="resetInput" class="btn btn-secondary">
                                    <i class="fas fa-sync"></i> Reset Filters
                                </button>
                            </div>
                        </div>

                        <!-- Add/Edit Form -->
                        <div class="mb-4 card">
                            <div class="card-header">
                                <h5>{{ $editId ? 'Edit' : 'Add' }} Timetable Entry</h5>
                            </div>
                            <div class="card-body">
                                <form wire:submit.prevent="save">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Class <span class="text-danger">*</span></label>
                                                <select wire:model="class_id" class="form-select @error('class_id') is-invalid @enderror">
                                                    <option value="">Select Class</option>
                                                    @foreach($classes as $class)
                                                        <option value="{{ $class->id }}">{{ $class->name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('class_id')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Subject <span class="text-danger">*</span></label>
                                                <select wire:model="subject_id" class="form-select @error('subject_id') is-invalid @enderror">
                                                    <option value="">Select Subject</option>
                                                    @foreach($subjects as $subject)
                                                        <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('subject_id')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Staff</label>
                                                <select wire:model="staff_id" class="form-select @error('staff_id') is-invalid @enderror">
                                                    <option value="">Select Staff</option>
                                                    @foreach($staffs as $staff)
                                                        <option value="{{ $staff->id }}">{{ $staff->firstname }} {{ $staff->lastname }}</option>
                                                    @endforeach
                                                </select>
                                                @error('staff_id')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Day <span class="text-danger">*</span></label>
                                                <select wire:model="day" class="form-select @error('day') is-invalid @enderror">
                                                    <option value="">Select Day</option>
                                                    <option value="Monday">Monday</option>
                                                    <option value="Tuesday">Tuesday</option>
                                                    <option value="Wednesday">Wednesday</option>
                                                    <option value="Thursday">Thursday</option>
                                                    <option value="Friday">Friday</option>
                                                    <option value="Saturday">Saturday</option>
                                                    <option value="Sunday">Sunday</option>
                                                </select>
                                                @error('day')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Start Time <span class="text-danger">*</span></label>
                                                <input type="time" wire:model="start_time" class="form-control @error('start_time') is-invalid @enderror">
                                                @error('start_time')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">End Time <span class="text-danger">*</span></label>
                                                <input type="time" wire:model="end_time" class="form-control @error('end_time') is-invalid @enderror">
                                                @error('end_time')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="gap-2 d-flex">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fas fa-save"></i> {{ $editId ? 'Update' : 'Save' }}
                                        </button>
                                        @if($editId)
                                            <button type="button" wire:click="resetInput" class="btn btn-secondary">
                                                <i class="fas fa-times"></i> Cancel
                                            </button>
                                        @endif
                                    </div>
                                </form>
                            </div>
                        </div>

                        <!-- Timetable Table -->
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="table-dark">
                                    <tr>
                                        <th>Class</th>
                                        <th>Subject</th>
                                        <th>Staff</th>
                                        <th>Day</th>
                                        <th>Start Time</th>
                                        <th>End Time</th>
                                        <th>Duration</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($timetables as $timetable)
                                        <tr>
                                            <td>
                                                <span class="badge bg-primary">{{ $timetable->class->name ?? 'N/A' }}</span>
                                            </td>
                                            <td>{{ $timetable->subject->name ?? 'N/A' }}</td>
                                            <td>{{ $timetable->staff->firstname ?? 'N/A' }}</td>
                                            <td>
                                                <span class="badge bg-info">{{ $timetable->day }}</span>
                                            </td>
                                            <td>{{ \Carbon\Carbon::parse($timetable->start_time)->format('h:i A') }}</td>
                                            <td>{{ \Carbon\Carbon::parse($timetable->end_time)->format('h:i A') }}</td>
                                            <td>
                                                @php
                                                    $start = \Carbon\Carbon::parse($timetable->start_time);
                                                    $end = \Carbon\Carbon::parse($timetable->end_time);
                                                    $duration = $start->diffInMinutes($end);
                                                @endphp
                                                <span class="badge bg-secondary">{{ $duration }} min</span>
                                            </td>
                                            <td>
                                                <div class="btn-group btn-group-sm">
                                                    <button wire:click="edit({{ $timetable->id }})" class="btn btn-outline-warning">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                    <button wire:click="delete({{ $timetable->id }})"
                                                            class="btn btn-outline-danger"
                                                            onclick="return confirm('Are you sure you want to delete this timetable entry?')">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="8" class="py-4 text-center text-muted">
                                                <i class="mb-3 fas fa-calendar-times fa-3x"></i>
                                                <p>No timetable entries found.</p>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        <div class="mt-3 d-flex justify-content-between align-items-center">
                            <div class="text-muted">
                                Showing {{ $timetables->firstItem() ?? 0 }} to {{ $timetables->lastItem() ?? 0 }} of {{ $timetables->total() }} entries
                            </div>
                            <div>
                                {{ $timetables->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Optional: Weekly View Modal -->
    <div wire:ignore.self class="modal fade" id="weeklyViewModal" tabindex="-1">
        <div class="modal-dialog modal-l">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Weekly Timetable View</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Time</th>
                                    <th>Monday</th>
                                    <th>Tuesday</th>
                                    <th>Wednesday</th>
                                    <th>Thursday</th>
                                    <th>Friday</th>
                                    <th>Saturday</th>
                                    <th>Sunday</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $timeSlots = ['08:00', '09:00', '10:00', '11:00', '12:00', '13:00', '14:00', '15:00', '16:00'];
                                    $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
                                @endphp
                                @foreach($timeSlots as $slot)
                                    <tr>
                                        <td class="fw-bold">{{ $slot }}</td>
                                        @foreach($days as $day)
                                            <td>
                                                @php
                                                    $entry = $timetables->where('day', $day)
                                                        ->where('start_time', '<=', $slot.':00')
                                                        ->where('end_time', '>', $slot.':00')
                                                        ->first();
                                                @endphp
                                                @if($entry)
                                                    <div class="p-1 text-center text-white rounded bg-primary">
                                                        <small>{{ $entry->subject->name ?? 'N/A' }}</small><br>
                                                        <small>{{ $entry->class->name ?? 'N/A' }}</small>
                                                    </div>
                                                @endif
                                            </td>
                                        @endforeach
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    .table-responsive {
        border-radius: 0.375rem;
    }

    .btn-group-sm > .btn {
        padding: 0.25rem 0.5rem;
    }

    .badge {
        font-size: 0.75em;
    }

    .card {
        box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
        border: 1px solid rgba(0, 0, 0, 0.125);
    }

    .alert {
        border-left: 4px solid;
    }

    .alert-success {
        border-left-color: #28a745;
    }

    .alert-danger {
        border-left-color: #dc3545;
    }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('livewire:init', () => {
        Livewire.on('close-modal', () => {
            const modal = bootstrap.Modal.getInstance(document.getElementById('weeklyViewModal'));
            if (modal) {
                modal.hide();
            }
        });
    });
</script>
@endpush
</div>
