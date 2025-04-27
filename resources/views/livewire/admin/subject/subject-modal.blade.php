

    <!-- Create brand -->
    <div wire:ignore.self class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createModalLabel">Add Subject</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="storeSubject">
                        <div class="mb-3">
                                <div class="form-group">
                                    <label>Class</label>
                                    <select wire:model.defer="class" id="" class="form-select">
                                        <option value="">--Select Class--</option>
                                        @forelse ($classes as $class)
                                            <option value="{{ $class->id }}">{{ $class->name }}</option>

                                        @empty
                                        <option>No Record</option>

                                        @endforelse
                                    </select>
                                    @error('class')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                        </div>
                        <div class="mb-3">
                            <label for="">Name</label>
                            <input type="text" wire:model.defer="name" class="form-control">
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="">Code</label>
                            <input type="text" wire:model.defer="code" class="form-control">
                            @error('code')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="" class="checkbox-label">Status</label>
                            <input type="checkbox" wire:model.defer="status" class="form-check-input"> <br>Checked=Hidden, Un-Checked=Visible

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Update brand -->

    <div wire:ignore.self class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Subject</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div wire:loading>

                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>loading....
                </div>

                <div wire:loading.remove>

                <div class="modal-body">
                        <form wire:submit.prevent="updateSubject">
                            <div class="mb-3">
                                <div class="form-group">
                                    <label>Class</label>
                                    <select wire:model="class" id="" class="form-select">
                                        <option value="">--Select Class--</option>
                                        @forelse ($classes as $class)
                                        <option value="{{$class->id}}">{{$class->name}}</option>
                                        @empty

                                        @endforelse
                                    </select>
                                    @error('class')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                        </div>
                            <div class="mb-3">
                                <label for="">Name</label>
                                <input type="text" wire:model.defer="name" class="form-control">
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="">Code</label>
                                <input type="text" wire:model.defer="code" class="form-control">
                                @error('code')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="" class="checkbox-label">Status</label>
                                <input type="checkbox" wire:model.defer="status" class="form-check-input"> <br>Checked=Hidden, Un-Checked=Visible

                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- delete Modal --}}
    <div wire:ignore.self class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog        ">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Delete Subject</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div wire:loading class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>Loading....

                <form  wire:submit.prevent='destroySubject'>
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
