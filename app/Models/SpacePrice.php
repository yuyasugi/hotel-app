<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpacePrice extends Model
{
    use HasFactory;

    public function reserve_space()
    {
        return $this->belongsTo(ReserveSpace::class);
    }
}
