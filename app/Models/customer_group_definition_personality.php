<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class customer_group_definition_personality extends Model
{
    use HasFactory;
    
    protected $fillable = ['id','customer_group_id','birth_year','created_by'];
}
