<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchases extends Model
{
    use HasFactory;
    

    protected $fillable = ['purchase_date','customer_code','branch_id','device_id', 'total_amount', 'total_vatamount'];

    public function purchased_item()
    {
        return $this->hasMany(Purchased_items::class);
    }
}
