<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class stock_cluster_members extends Model
{
    use HasFactory;
    
    protected $fillable = ['stock_code','is_included','stock_cluster_id'];

    public function stockCluster()
    {
        return $this->belongsTo(StockCluster::class);
    }
}
