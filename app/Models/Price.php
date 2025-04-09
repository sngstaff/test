<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Price extends Model
{
    use HasFactory;

    public $timestamps = false;

    public $fillable = [
        'configuration_id', 'price',
        'start_date', 'end_date'
    ];

    public function configuration(): BelongsTo
    {
        return $this->belongsTo(Configuration::class);
    }

    public function scopeActive($q)
    {
        $currentDate = now();

        return $q->where('start_date', '<=', $currentDate)
            ->where('end_date', '>=', $currentDate)
            ->where('price', '>', 0);
    }
}
