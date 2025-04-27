<!-- Create brand -->
<div wire:ignore.self class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel">Add Resumption</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form wire:submit.prevent="createResumption">
                    <div class="mb-3">
                        <div class="form-group">
                            <label>Session</label>
                            <select wire:model.defer="session" id="" class="form-select">
                                <option value="">--Select Session--</option>
                                @forelse ($sessions as $session)
                                    <option value="{{ $session->id }}">{{ $session->name }}</option>

                                @empty
                                    <option value="">--No Record--</option>
                                @endforelse

                            </select>
                            @error('session')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="form-group">
                            <label>Semester</label>
                            <select wire:model.defer="semester" id="" class="form-select">
                                <option value="">--Select Semester--</option>
                                @forelse ($semesters as $semester)
                                    <option value="{{ $semester->id }}">{{ $semester->name }}</option>

                                @empty
                                    <option value="">--No Record--</option>
                                @endforelse

                            </select>
                            @error('semester')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="">Vacation Date</label>
                        <input type="date" wire:model.defer="vacation_date" class="form-control">
                        @error('vacation_date')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="">Resumption Date</label>
                        <input type="date" wire:model.defer="resumption_date" class="form-control">
                        @error('resumption_date')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
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
                <h5 class="modal-title" id="editModalLabel">Edit Resumption</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div wire:loading>

                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>loading....
            </div>

            <div wire:loading.remove>
                <div class="modal-body">
                    <form wire:submit.prevent="updateResumption">
                        <div class="mb-3">
                            <div class="form-group">
                                <label>Session</label>
                                <select wire:model.defer="session" id="" class="form-select">
                                    <option value="">--Select Session--</option>
                                    @forelse ($sessions as $session)
                                        <option value="{{ $session->id }}">{{ $session->name }}</option>

                                    @empty
                                        <option value="">--No Record--</option>
                                    @endforelse

                                </select>
                                @error('session')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="form-group">
                                <label>Semester</label>
                                <select wire:model.defer="semester" id="" class="form-select">
                                    <option value="">--Select Semester--</option>
                                    @forelse ($semesters as $semester)
                                        <option value="{{ $semester->id }}">{{ $semester->name }}</option>

                                    @empty
                                        <option value="">--No Record--</option>
                                    @endforelse

                                </select>
                                @error('semester')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="">Vacation Date</label>
                            <input type="text" wire:model.defer="vacation_date" class="form-control">
                            @error('vacation_date')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="">Resumption Date</label>
                            <input type="text" wire:model.defer="resumption_date" class="form-control">
                            @error('resumption_date')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
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
    <div class="modal-dialog        ">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Delete Subject</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div wire:loading class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>Loading....

            <form wire:submit.prevent='destroyResumption'>
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
