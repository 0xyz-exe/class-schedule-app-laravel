<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function index(Request $request)
    {
        $query = Schedule::query();
        
        if ($day = $request->get('day')) {
            $query->byDay($day);
        } else {
            $query->orderBy('day')->orderBy('start_time');
        }
        
        if ($semester = $request->get('semester')) {
            $query->bySemester($semester);
        }
        
        $schedules = $query->paginate(15);
        
        return view('schedules.index', compact('schedules'));
    }

    public function create()
    {
        return view('schedules.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'course_code' => 'required|string|max:20',
            'course_name' => 'required|string|max:255',
            'instructor' => 'required|string|max:255',
            'room' => 'required|string|max:50',
            'day' => 'required|in:Monday,Tuesday,Wednesday,Thursday,Friday,Saturday',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'semester' => 'required|string|max:50',
            'credits' => 'required|integer|min:1|max:6',
        ]);

        $schedule = new Schedule();
        if ($schedule->hasConflict($validated['day'], $validated['start_time'], $validated['end_time'])) {
            return back()->withErrors(['conflict' => 'Time conflict detected with existing schedule.'])->withInput();
        }

        Schedule::create($validated);

        return redirect()->route('schedules.index')
            ->with('success', 'Schedule created successfully.');
    }

    public function edit(Schedule $schedule)
    {
        return view('schedules.edit', compact('schedule'));
    }

    public function update(Request $request, Schedule $schedule)
    {
        $validated = $request->validate([
            'course_code' => 'required|string|max:20',
            'course_name' => 'required|string|max:255',
            'instructor' => 'required|string|max:255',
            'room' => 'required|string|max:50',
            'day' => 'required|in:Monday,Tuesday,Wednesday,Thursday,Friday,Saturday',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'semester' => 'required|string|max:50',
            'credits' => 'required|integer|min:1|max:6',
        ]);

        if ($schedule->hasConflict($validated['day'], $validated['start_time'], $validated['end_time'], $schedule->id)) {
            return back()->withErrors(['conflict' => 'Time conflict detected with existing schedule.'])->withInput();
        }

        $schedule->update($validated);

        return redirect()->route('schedules.index')
            ->with('success', 'Schedule updated successfully.');
    }

    public function destroy(Schedule $schedule)
    {
        $schedule->delete();

        return redirect()->route('schedules.index')
            ->with('success', 'Schedule deleted successfully.');
    }

    public function timetable(Request $request)
    {
        $semester = $request->get('semester', 'Fall 2024');
        $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
        
        $schedules = Schedule::bySemester($semester)
            ->orderBy('day')
            ->orderBy('start_time')
            ->get()
            ->groupBy('day');
        
        return view('schedules.timetable', compact('schedules', 'days', 'semester'));
    }
}
