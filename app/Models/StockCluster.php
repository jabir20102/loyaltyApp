<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockCluster extends Model
{
    use HasFactory;
    protected $fillable = ['cluster_name', 'isActive', 'created_by'];
}
