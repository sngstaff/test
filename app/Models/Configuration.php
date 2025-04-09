<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Configuration extends Model
{
    use HasFactory;

    public $fillable = [
        'car_id', 'name'
    ];

    public function car(): BelongsTo
    {
        return $this->belongsTo(Car::class);
    }

    public function options(): BelongsToMany
    {
        return $this->belongsToMany(Option::class, 'configuration_options');
    }

    public function price(): HasOne
    {
        return $this->hasOne(Price::class);
    }
}
