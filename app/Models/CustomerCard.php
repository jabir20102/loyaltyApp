<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerCard extends Model
{
    use HasFactory;


    protected $fillable = [
        'customer_id',
        'cc_card_no',
        'cc_isValid',
        'cc_validFrom',
        'cc_validTo',
        'cc_total_earn',
        'cc_total_spent',
        'cc_type',
        'cc_status',
        'cc_createdate',
        'cc_update',
    ];

    protected $dates = [
        'cc_createdate',
        'cc_update',
    ];
}
