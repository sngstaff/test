<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Option extends Model
{
    use HasFactory;

    public $fillable = [
        'name'
    ];

    public function configurations(): BelongsToMany
    {
        return $this->belongsToMany(Configuration::class);
    }
}
