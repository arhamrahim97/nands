<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FrequentItem extends Model
{
    use HasFactory;
    protected $table = 'frequent_item';
    protected $guarded = ['id'];
}
