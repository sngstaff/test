<?php

namespace App\Models;

use App\Enums\UserGateEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;

    protected $fillable = [
        'name', 'email',
        'password', 'gate'
    ];

    protected $hidden = [
        'password'
    ];

    public function scopeWhereGate($query, UserGateEnum $gate)
    {
        return $query->where('gate', $gate->value);
    }
}
