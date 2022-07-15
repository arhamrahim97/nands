<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConfidenceItemset extends Model
{
    use HasFactory;
    protected $table = 'confidence_itemset';
    protected $guarded = ['id'];
}
