<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductGroup extends Model
{
    use HasFactory;
    protected $fillable = ['group_name'];
    

    public function subgroups()
    {
        return $this->hasMany(ProductSubgroup::class, 'product_group_id');
    }
    
}
