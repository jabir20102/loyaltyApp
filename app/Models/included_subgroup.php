<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class included_subgroup extends Model
{
    use HasFactory;
    protected $fillable = ['subgroup_name', 'created_by','cluster_id'];

}
