<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'amount',
        'date',
        'tuition_id',
    ];

    public function tuition(): BelongsTo
    {
        return $this->belongsTo(Tuition::class);
    }
}
