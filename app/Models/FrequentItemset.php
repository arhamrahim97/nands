<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FrequentItemset extends Model
{
    use HasFactory;
    protected $table = 'frequent_itemset';
    protected $guarded = ['id'];
}
