<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderStatus extends Model
{
        use SoftDeletes;
    protected $table = 'order_status';

    protected $fillable = [
        'id',
        'name',
        'process_order',
        'for',
         'for_role',
         'not_edit_order',
         'order_by',
        'color',
        'image_icon',

    ];

    protected $casts = [
        'updated_at' => 'datetime',
        'created_at' => 'datetime',
    ];

     public function orders()
    {
    return $this->hasMany(Order::class, 'order_status_id');
   }

    public function getCreatedAtAttribute($value)
    {
        return \Carbon\Carbon::parse($value)->format('d-m-Y H:i A');
    }

    public function getUpdatedAtAttribute($value)
    {
        return \Carbon\Carbon::parse($value)->format('d-m-Y H:i A');
    }
}
