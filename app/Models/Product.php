<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name','name1','name2','name3', 'code', 'type_id', 'special_code1','special_code2','special_code3', 'category_id', 'product_group_id','product_subgroup_id'];


   
}
