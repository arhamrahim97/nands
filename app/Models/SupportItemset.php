<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupportItemset extends Model
{
    use HasFactory;
    protected $table = 'support_itemset';
    protected $guarded = ['id'];
}
