<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ConfigurationOption extends Model
{
    use HasFactory;

    public $timestamps = false;

    public $fillable = [
        'configuration_id', 'option_id'
    ];

    public function configuration(): BelongsTo
    {
        return $this->belongsTo(Configuration::class);
    }

    public function option(): BelongsTo
    {
        return $this->belongsTo(Option::class);
    }
}
