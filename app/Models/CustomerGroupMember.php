<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerGroupMember extends Model
{
    protected $fillable = ['customer_group_id', 'customer_id','customer_code', 'created_by','source'];

    public function customer()
{
    return $this->belongsTo(Customer::class, 'customer_id');
}

public function customer_group()
{
    return $this->belongsTo(CustomerGroup::class, 'customer_group_id')->select('id', 'group_name');
}
public function user()
{
    return $this->belongsTo(User::class, 'created_by')->select('id', 'name');
}
}
