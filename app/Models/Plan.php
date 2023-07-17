<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'content', 'cheapest_price'];

    public function images()
{
    return $this->hasMany(PlanImage::class);
}
}
