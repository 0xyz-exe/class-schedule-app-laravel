<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-semibold mb-4">Welcome to Class Schedule Management</h3>
                    <p class="mb-4">Manage course schedules and view timetables.</p>
                    <div class="flex gap-2">
                        <a href="{{ route('schedules.index') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Manage Schedules
                        </a>
                        <a href="{{ route('schedules.timetable') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                            View Timetable
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
