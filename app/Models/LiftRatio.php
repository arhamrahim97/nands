<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LiftRatio extends Model
{
    use HasFactory;
    protected $table = 'lift_ratio';
    protected $guarded = ['id'];
}
