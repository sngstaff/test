<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Car extends Model
{
    use HasFactory;

    public $fillable = [
        'name'
    ];

    public function configurations(): HasMany
    {
        return $this->hasMany(Configuration::class);
    }

    public function scopeAvailable($query)
    {
        return $query->whereHas('configurations', function ($q) {
            $q->whereHas('price', fn ($q) => $q->active());
        });
    }

    public function scopeWithAvailableConfigurations($query)
    {
        return $query->with([
            'configurations' => function ($q) {
                $q->whereHas('price', fn ($q) => $q->active())
                ->with([
                    'options:id,name',
                    'price' => fn ($q) => $q->active()
                ]);
            }
        ]);
    }
}
