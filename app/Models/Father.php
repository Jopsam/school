<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Notifications\Notifiable;

class Father extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'phone',
    ];

    public function students(): HasMany
    {
        return $this->hasMany(Student::class);
    }

    public static function getEmailsByCourse(int $courseId): array
    {
        return self::whereHas('students.tuitions.course', function ($query) use ($courseId) {
            $query->where('id', $courseId);
        })->pluck('email')->toArray();
    }

    public static function getEmailsByAge(int $age): array
    {
        return self::whereHas('students', function ($query) use ($age) {
            $query->whereYear('birth_date', now()->year - $age);
        })->pluck('email')->toArray();
    }
}
