<!-- Create brand -->
<div wire:ignore.self class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <form wire:submit.prevent="save">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Question</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    {{-- Question Title --}}
                    <div class="mb-3">
                        <label class="form-label">Question Title</label>
                        <input wire:model="title" class="form-control" placeholder="Enter the question">
                        @error('title')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>



                    {{-- Class --}}
                    <div class="mb-3">
                        <label class="form-label">Class</label>
                        <select wire:model.live="class_id" class="form-select">
                            <option value="">Select Class</option>
                            @forelse ($classes as $value)
                            <option value="{{ $value->id }}">{{ $value->name }}</option>
                            @empty
                            <option value="">No values</option>
                            @endforelse
                        </select>
                        @error('class_id')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Subject --}}
                    <div class="mb-3">
                        <label class="form-label">Subject</label>
                        <select wire:model.live="subject_id" class="form-select">
                            <option value="">Select Subject</option>
                            @forelse ($subjects as $value)
                            <option value="{{ $value->id }}">{{ $value->name }}</option>
                            @empty
                            <option value="">No values</option>
                            @endforelse
                        </select>
                        @error('subject_id')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>


                    {{-- Term --}}
                    <div class="mb-3">
                        <label class="form-label">Term</label>
                        <select wire:model="term_id" class="form-select">
                            <option value="">Select Term</option>
                            @forelse ($semesters as $value)
                            <option value="{{ $value->id }}">{{ $value->name }}</option>
                            @empty
                            <option value="">No values</option>
                            @endforelse
                        </select>
                        @error('term_id')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Session --}}
                    <div class="mb-3">
                        <label class="form-label">Session</label>
                        <select wire:model="session_id" class="form-select">
                            <option value="">Select Session</option>
                            @forelse ($sessions as $value)
                            <option value="{{ $value->id }}">{{ $value->name }}</option>
                            @empty
                            <option value="">No values</option>
                            @endforelse
                        </select>
                        @error('session_id')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">File</label>
                        <input type="file" wire:model="file" class="form-control" placeholder="" />
                        @error('file')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>







                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save Question</button>
                </div>
            </form>

        </div>
    </div>
</div>
<!-- Create brand -->
{{-- <div wire:ignore.self class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <form wire:submit.prevent="save">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Question</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Question Title</label>
                        <input wire:model="title" class="form-control" placeholder="Enter the question">
                        @error('title')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Type</label>
                        <select wire:model="type" class="form-select">
                            <option value="objective">Objective</option>
                            <option value="theory">Theory</option>
                        </select>
                        @error('type')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Subject</label>
                        <input type="text" wire:model="subject" class="form-control"
                            placeholder="e.g. English, Maths" />
                        @error('subject')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>


                    <div class="mb-3">
                        <label class="form-label">Class</label>
                        <input type="text" wire:model="class" class="form-control" placeholder="e.g. JSS 2, SSS 3" />
                        @error('class')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Term</label>
                        <select wire:model="term" class="form-select">
                            <option value="">Select Term</option>
                            <option value="First Term">First Term</option>
                            <option value="Second Term">Second Term</option>
                            <option value="Third Term">Third Term</option>
                        </select>
                        @error('term')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Session</label>
                        <input type="text" wire:model="session" class="form-control" placeholder="e.g. 2024/2025" />
                        @error('session')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    @if ($type === 'objective')
                    <div class="mb-3">
                        <label class="form-label">Options</label>
                        @foreach ($options as $index => $option)
                        <div class="mb-2 input-group">
                            <input type="text" wire:model="options.{{ $index }}" class="form-control"
                                placeholder="Option {{ chr(65 + $index) }}">
                            <button type="button" class="btn btn-danger"
                                wire:click="removeOption({{ $index }})">×</button>
                        </div>
                        @endforeach
                        <button type="button" class="mt-2 btn btn-sm btn-secondary" wire:click="addOption">Add
                            Option</button>
                        @error('options')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Correct Option</label>
                        <input type="text" wire:model="correct_option" class="form-control"
                            placeholder="e.g. A or Abuja">
                        @error('correct_option')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    @endif

                    @if ($type === 'theory')
                    <div class="mb-3">
                        <label class="form-label">Answer</label>
                        <textarea wire:model="answer" class="form-control" rows="4"
                            placeholder="Write full answer here..."></textarea>
                        @error('answer')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    @endif
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save Question</button>
                </div>
            </form>

        </div>
    </div>
</div> --}}
<!-- Update brand -->

<div wire:ignore.self class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form wire:submit.prevent='updatePast'>
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Past Question</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div wire:loading>

                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>loading....
                </div>

                <div wire:loading.remove>

                    <div class="modal-body">
                        {{-- Question Title --}}
                        <div class="mb-3">
                            <label class="form-label">Question Title</label>
                            <input wire:model="title" class="form-control" placeholder="Enter the question">
                            @error('title')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>



                        {{-- Class --}}
                        <div class="mb-3">
                            <label class="form-label">Class</label>
                            <select wire:model.live="class_id" class="form-select">
                                <option value="">Select Class</option>
                                @forelse ($classes as $value)
                                <option value="{{ $value->id }}">{{ $value->name }}</option>
                                @empty
                                <option value="">No values</option>
                                @endforelse
                            </select>
                            @error('class_id')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Subject --}}
                        <div class="mb-3">
                            <label class="form-label">Subject</label>
                            <select wire:model.live="subject_id" class="form-select">
                                <option value="">Select Subject</option>
                                @forelse ($subjects as $value)
                                <option value="{{ $value->id }}">{{ $value->name }}</option>
                                @empty
                                <option value="">No values</option>
                                @endforelse
                            </select>
                            @error('subject_id')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>


                        {{-- Term --}}
                        <div class="mb-3">
                            <label class="form-label">Term</label>
                            <select wire:model="term_id" class="form-select">
                                <option value="">Select Term</option>
                                @forelse ($semesters as $value)
                                <option value="{{ $value->id }}">{{ $value->name }}</option>
                                @empty
                                <option value="">No values</option>
                                @endforelse
                            </select>
                            @error('term_id')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Session --}}
                        <div class="mb-3">
                            <label class="form-label">Session</label>
                            <select wire:model="session_id" class="form-select">
                                <option value="">Select Session</option>
                                @forelse ($sessions as $value)
                                <option value="{{ $value->id }}">{{ $value->name }}</option>
                                @empty
                                <option value="">No values</option>
                                @endforelse
                            </select>
                            @error('session_id')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">File</label>
                            <input type="file" wire:model="file" class="form-control" placeholder="" />
                            @error('file')
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
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Delete Past Question</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div wire:loading class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>Loading....

            <form wire:submit.prevent='destroyPast'>
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