{{-- resources/views/livewire/timetable.blade.php --}}
<div>
    <div class="flex items-center justify-between mb-4">
        <div>
            <label for="classFilter" class="font-semibold">Filter by Class:</label>
            <select wire:model="selectedClass" id="classFilter" class="px-3 py-1 border rounded">
                <option value="">All Classes</option>
                @foreach($classes as $class)
                    <option value="{{ $class->id }}">{{ $class->name }}</option>
                @endforeach
            </select>

            <label for="dayFilter" class="ml-4 font-semibold">Filter by Day:</label>
            <select wire:model="selectedDay" id="dayFilter" class="px-3 py-1 border rounded">
                <option value="">All Days</option>
                @foreach($days as $day)
                    <option value="{{ $day }}">{{ $day }}</option>
                @endforeach
            </select>
        </div>

        <button wire:click="exportExcel" class="px-4 py-2 text-white bg-green-500 rounded hover:bg-green-600">Export Excel</button>
    </div>

    <table class="w-full text-sm border border-collapse table-auto">
        <thead>
            <tr class="bg-gray-200">
                <th class="px-4 py-2 border">Day</th>
                <th class="px-4 py-2 border">Period</th>
                <th class="px-4 py-2 border">Subject</th>
                <th class="px-4 py-2 border">Teacher</th>
                <th class="px-4 py-2 border">Class</th>
                <th class="px-4 py-2 border">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($timetable as $entry)
                <tr>
                    <td class="px-4 py-2 border">{{ $entry->day }}</td>
                    <td class="px-4 py-2 border">{{ $entry->period }}</td>
                    <td class="px-4 py-2 border">{{ $entry->subject->name }}</td>
                    <td class="px-4 py-2 border">{{ $entry->teacher->name }}</td>
                    <td class="px-4 py-2 border">{{ $entry->class->name }}</td>
                    <td class="px-4 py-2 border">
                        <button wire:click="edit({{ $entry->id }})" class="text-blue-600">Edit</button>
                        <button wire:click="delete({{ $entry->id }})" class="ml-2 text-red-600">Delete</button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="py-4 text-center">No timetable entries found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
