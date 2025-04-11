<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'last_name',
        'birth_date',
        'father_id',
    ];

    public function father(): BelongsTo
    {
        return $this->belongsTo(Father::class);
    }

    public function tuitions(): HasMany
    {
        return $this->hasMany(Tuition::class);
    }
}
