<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductSubGroup extends Model
{
    use HasFactory;
    protected $fillable = ['sub_group_name','product_group_id'];
    

    public function group()
    {
        return $this->belongsTo(ProductGroup::class, 'product_group_id');
    }
}
