<!-- Create brand -->
<div wire:ignore.self class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel">Add Total Attendance</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form wire:submit.prevent="storeTotalAttendance">
                    <div class="mb-3">
                        <div class="form-group">
                            <label>Session</label>
                            <select wire:model.defer="session_id" id="" class="form-select">
                                <option value="">--Select Session--</option>
                                @forelse ($sessions as $value)
                                    <option value="{{ $value->id }}">{{ $value->name }}</option>

                                @empty
                                    <option>No Record</option>
                                @endforelse
                            </select>
                            @error('session_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="form-group">
                            <label>Term</label>
                            <select wire:model.defer="semester" id="" class="form-select">
                                <option value="">--Select Term--</option>
                                @forelse ($semesters as $value)
                                    <option value="{{ $value->id }}">{{ $value->name }}</option>

                                @empty
                                    <option>No Record</option>
                                @endforelse
                            </select>
                            @error('semester')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="">Total</label>
                        <input type="number" wire:model.defer="total" class="form-control">
                        @error('total')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="" class="checkbox-label">Status</label>
                        <input type="checkbox" wire:model.defer="status" class="form-check-input"> <br>Checked=Hidden,
                        Un-Checked=Visible

                    </div>
            </div>
            <div class="modal-footer">
                <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- Update brand -->

<div wire:ignore.self class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit TotalAttendance</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div wire:loading>

                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>loading....
            </div>

            <div wire:loading.remove>

                <div class="modal-body">
                    <form wire:submit.prevent="updateTotalAttendance">
                        <div class="mb-3">
                            <div class="form-group">
                                <label>Session</label>
                                <select wire:model.defer="session_id" id="" class="form-select">
                                    <option value="">--Select Session--</option>
                                    @forelse ($sessions as $value)
                                        <option value="{{ $value->id }}">{{ $value->name }}</option>

                                    @empty
                                        <option>No Record</option>
                                    @endforelse
                                </select>
                                @error('session_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="form-group">
                                <label>Term</label>
                                <select wire:model.defer="semester" id="" class="form-select">
                                    <option value="">--Select Term--</option>
                                    @forelse ($semesters as $value)
                                        <option value="{{ $value->id }}">{{ $value->name }}</option>

                                    @empty
                                        <option>No Record</option>
                                    @endforelse
                                </select>
                                @error('semester')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="">Total</label>
                            <input type="number" wire:model.defer="total" class="form-control">
                            @error('total')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="" class="checkbox-label">Status</label>
                            <input type="checkbox" wire:model.defer="status" class="form-check-input"> <br>Checked=Hidden,
                            Un-Checked=Visible

                        </div>

                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- delete Modal --}}
<div wire:ignore.self class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel"
    aria-hidden="true">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Delete Total Attendance</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div wire:loading class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>Loading....

            <form wire:submit.prevent='destroyTotalAttendance'>
                <div wire:loading.remove>

                    <div class="modal-body">
                        <h6>Are you sure you want to delete this data?</h6>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Yes. Delete</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
