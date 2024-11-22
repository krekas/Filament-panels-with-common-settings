<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Hotel extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'address',
        'description',
        'photo',
        'is_published',
    ];

    protected $casts = [
        'is_published' => 'bool',
    ];

    public function rooms(): HasMany
    {
        return $this->hasMany(Room::class);
    }
}
