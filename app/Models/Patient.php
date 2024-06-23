<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'birth',
        'gender',
    ];

    public function roomallocation()
    {
        return $this->hasMany(RoomAllocation::class);
    }

}
