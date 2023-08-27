<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class customer_group_definition_cardno extends Model
{
    use HasFactory;
    protected $fillable = ['id','customer_group_id','card_no_start','card_no_end','created_by'];
}
