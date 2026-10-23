<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Schedule') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    @if ($errors->has('conflict'))
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
                            {{ $errors->first('conflict') }}
                        </div>
                    @endif

                    <form action="{{ route('schedules.update', $schedule) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="course_code" class="block text-sm font-medium text-gray-700">Course Code</label>
                                <input type="text" name="course_code" id="course_code" value="{{ old('course_code', $schedule->course_code) }}" 
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                                @error('course_code')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="course_name" class="block text-sm font-medium text-gray-700">Course Name</label>
                                <input type="text" name="course_name" id="course_name" value="{{ old('course_name', $schedule->course_name) }}" 
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                                @error('course_name')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="instructor" class="block text-sm font-medium text-gray-700">Instructor</label>
                                <input type="text" name="instructor" id="instructor" value="{{ old('instructor', $schedule->instructor) }}" 
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                                @error('instructor')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="room" class="block text-sm font-medium text-gray-700">Room</label>
                                <input type="text" name="room" id="room" value="{{ old('room', $schedule->room) }}" 
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                                @error('room')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="day" class="block text-sm font-medium text-gray-700">Day</label>
                                <select name="day" id="day" 
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                                    <option value="">Select Day</option>
                                    <option value="Monday" {{ old('day', $schedule->day) === 'Monday' ? 'selected' : '' }}>Monday</option>
                                    <option value="Tuesday" {{ old('day', $schedule->day) === 'Tuesday' ? 'selected' : '' }}>Tuesday</option>
                                    <option value="Wednesday" {{ old('day', $schedule->day) === 'Wednesday' ? 'selected' : '' }}>Wednesday</option>
                                    <option value="Thursday" {{ old('day', $schedule->day) === 'Thursday' ? 'selected' : '' }}>Thursday</option>
                                    <option value="Friday" {{ old('day', $schedule->day) === 'Friday' ? 'selected' : '' }}>Friday</option>
                                    <option value="Saturday" {{ old('day', $schedule->day) === 'Saturday' ? 'selected' : '' }}>Saturday</option>
                                </select>
                                @error('day')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="semester" class="block text-sm font-medium text-gray-700">Semester</label>
                                <input type="text" name="semester" id="semester" value="{{ old('semester', $schedule->semester) }}" 
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                                @error('semester')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="start_time" class="block text-sm font-medium text-gray-700">Start Time</label>
                                <input type="time" name="start_time" id="start_time" value="{{ old('start_time', $schedule->start_time->format('H:i')) }}" 
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                                @error('start_time')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="end_time" class="block text-sm font-medium text-gray-700">End Time</label>
                                <input type="time" name="end_time" id="end_time" value="{{ old('end_time', $schedule->end_time->format('H:i')) }}" 
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                                @error('end_time')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="credits" class="block text-sm font-medium text-gray-700">Credits</label>
                                <input type="number" name="credits" id="credits" min="1" max="6" value="{{ old('credits', $schedule->credits) }}" 
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                                @error('credits')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="flex gap-2 mt-6">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Update Schedule
                            </button>
                            <a href="{{ route('schedules.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded">
                                Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
