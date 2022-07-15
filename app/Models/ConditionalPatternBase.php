<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConditionalPatternBase extends Model
{
    use HasFactory;
    protected $table = 'conditional_pattern_base';
    protected $guarded = ['id'];
}
