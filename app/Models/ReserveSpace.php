<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReserveSpace extends Model
{
    use HasFactory;

    protected $fillable = ['room_id', 'date', 'count'];

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function space_price()
    {
        return $this->hasMany(SpacePrice::class);
    }
}
