<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Class Schedules') }}
            </h2>
            <div class="flex gap-2">
                <a href="{{ route('schedules.timetable') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                    View Timetable
                </a>
                <a href="{{ route('schedules.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Add Schedule
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form method="GET" action="{{ route('schedules.index') }}" class="mb-4">
                        <div class="flex gap-2">
                            <select name="day" class="rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                <option value="">All Days</option>
                                <option value="Monday" {{ request('day') === 'Monday' ? 'selected' : '' }}>Monday</option>
                                <option value="Tuesday" {{ request('day') === 'Tuesday' ? 'selected' : '' }}>Tuesday</option>
                                <option value="Wednesday" {{ request('day') === 'Wednesday' ? 'selected' : '' }}>Wednesday</option>
                                <option value="Thursday" {{ request('day') === 'Thursday' ? 'selected' : '' }}>Thursday</option>
                                <option value="Friday" {{ request('day') === 'Friday' ? 'selected' : '' }}>Friday</option>
                                <option value="Saturday" {{ request('day') === 'Saturday' ? 'selected' : '' }}>Saturday</option>
                            </select>
                            <input type="text" name="semester" value="{{ request('semester') }}" placeholder="Semester (e.g., Fall 2024)"
                                   class="rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            <button type="submit" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                                Filter
                            </button>
                            @if(request('day') || request('semester'))
                                <a href="{{ route('schedules.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded">
                                    Clear
                                </a>
                            @endif
                        </div>
                    </form>

                    @if ($schedules->isEmpty())
                        <p class="text-gray-500 text-center py-8">No schedules found.</p>
                    @else
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Course</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Instructor</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Day</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Time</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Room</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Credits</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach ($schedules as $schedule)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm font-medium text-gray-900">{{ $schedule->course_code }}</div>
                                                <div class="text-sm text-gray-500">{{ $schedule->course_name }}</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $schedule->instructor }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $schedule->day }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                {{ $schedule->start_time->format('H:i') }} - {{ $schedule->end_time->format('H:i') }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $schedule->room }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $schedule->credits }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                                                <a href="{{ route('schedules.edit', $schedule) }}" class="text-blue-600 hover:text-blue-900">Edit</a>
                                                <form action="{{ route('schedules.destroy', $schedule) }}" method="POST" class="inline" onsubmit="return confirm('Delete this schedule?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="mt-4">
                            {{ $schedules->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
