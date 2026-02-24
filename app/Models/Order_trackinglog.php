<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order_trackinglog extends Model
{
    use SoftDeletes;

    protected $table = 'order_trackinglogs';
    protected $fillable = [
        'order_id',
        'remark',
        'status',
        'time',
        'assigned_to',
        'assigned_by',
        'department',
    ];

    protected $dates = [
        'time',
        'deleted_at',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    public function assignedTo()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    public function assignedBy()
    {
        return $this->belongsTo(User::class, 'assigned_by');
    }
}
