<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchased_items extends Model
{
    use HasFactory;
    

    protected $fillable = ['item_id','item_barcode','purchases_id','item_name', 'quantity', 'price_per_unit','total_pricewithvat'];

    public function purchases()
    {
        return $this->belongsTo(Purchases::class);
    }
}
