<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'surname','customer_code','gender','email', 'tel1','tel2', 'address', 'birthdate'];

    public function cards()
    {
        return $this->hasMany(CustomerCard::class, 'customer_id');
    }
    
}
