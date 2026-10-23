<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Class Timetable') }}
            </h2>
            <a href="{{ route('schedules.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                Back to List
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="mb-4">
                        <form method="GET" action="{{ route('schedules.timetable') }}" class="flex gap-2">
                            <input type="text" name="semester" value="{{ $semester }}" placeholder="Semester"
                                   class="rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Filter
                            </button>
                        </form>
                    </div>

                    <h3 class="text-lg font-semibold mb-4">{{ $semester }}</h3>

                    @if ($schedules->isEmpty())
                        <p class="text-gray-500 text-center py-8">No schedules found for this semester.</p>
                    @else
                        <div class="overflow-x-auto">
                            <table class="min-w-full border-collapse border border-gray-300">
                                <thead>
                                    <tr class="bg-gray-100">
                                        <th class="border border-gray-300 px-4 py-2 text-left">Time</th>
                                        @foreach ($days as $day)
                                            <th class="border border-gray-300 px-4 py-2 text-center">{{ $day }}</th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $timeSlots = [];
                                        foreach ($schedules as $daySchedules) {
                                            foreach ($daySchedules as $schedule) {
                                                $timeSlots[] = $schedule->start_time->format('H:i') . '-' . $schedule->end_time->format('H:i');
                                            }
                                        }
                                        $timeSlots = array_unique($timeSlots);
                                        sort($timeSlots);
                                    @endphp

                                    @forelse ($timeSlots as $timeSlot)
                                        <tr>
                                            <td class="border border-gray-300 px-4 py-2 bg-gray-50 font-medium">{{ $timeSlot }}</td>
                                            @foreach ($days as $day)
                                                <td class="border border-gray-300 px-4 py-2">
                                                    @php
                                                        $daySchedules = $schedules->get($day, collect());
                                                        $slotSchedule = $daySchedules->first(function($s) use ($timeSlot) {
                                                            return ($s->start_time->format('H:i') . '-' . $s->end_time->format('H:i')) === $timeSlot;
                                                        });
                                                    @endphp
                                                    @if ($slotSchedule)
                                                        <div class="bg-blue-100 p-2 rounded">
                                                            <div class="font-semibold text-sm">{{ $slotSchedule->course_code }}</div>
                                                            <div class="text-xs text-gray-600">{{ $slotSchedule->course_name }}</div>
                                                            <div class="text-xs text-gray-600 mt-1">{{ $slotSchedule->instructor }}</div>
                                                            <div class="text-xs text-gray-500">{{ $slotSchedule->room }}</div>
                                                        </div>
                                                    @endif
                                                </td>
                                            @endforeach
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="{{ count($days) + 1 }}" class="border border-gray-300 px-4 py-8 text-center text-gray-500">
                                                No schedules found.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
