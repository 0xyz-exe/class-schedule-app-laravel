<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Schedule extends Model
{
    protected $fillable = [
        'course_code',
        'course_name',
        'instructor',
        'room',
        'day',
        'start_time',
        'end_time',
        'semester',
        'credits',
    ];

    protected function casts(): array
    {
        return [
            'start_time' => 'datetime:H:i',
            'end_time' => 'datetime:H:i',
            'credits' => 'integer',
        ];
    }

    public function hasConflict($day, $startTime, $endTime, $excludeId = null)
    {
        $query = self::where('day', $day)
            ->where(function($q) use ($startTime, $endTime) {
                $q->whereBetween('start_time', [$startTime, $endTime])
                  ->orWhereBetween('end_time', [$startTime, $endTime])
                  ->orWhere(function($q2) use ($startTime, $endTime) {
                      $q2->where('start_time', '<=', $startTime)
                         ->where('end_time', '>=', $endTime);
                  });
            });

        if ($excludeId) {
            $query->where('id', '!=', $excludeId);
        }

        return $query->exists();
    }

    public function scopeByDay($query, $day)
    {
        return $query->where('day', $day)->orderBy('start_time');
    }

    public function scopeBySemester($query, $semester)
    {
        return $query->where('semester', $semester);
    }
}
