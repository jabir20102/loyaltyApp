<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class included_group extends Model
{
    use HasFactory;
    protected $fillable = ['group_name', 'created_by','cluster_id'];

   
}
