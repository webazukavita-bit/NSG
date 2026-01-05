<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
        use SoftDeletes;
    protected $table = 'orders';

    protected $fillable = [
        'id',
        'code',
        'order_by_id',
        'user_id',
         'product_details',
         'address',
         'tax_type',
        'order_tax',
        'final_amount',
        'order_status_id',
        'payment_status_id',
        'payment_method',
        'ledger_id',

    ];

    protected $casts = [
        'updated_at' => 'datetime',
        'created_at' => 'datetime',
    ];

      public function user(){
        return $this->belongsTo(User::class);
      }
     public function status()
{
    return $this->belongsTo(OrderStatus::class, 'order_status_id')->withTrashed();
}
public function paymentStatus()
{
    return $this->belongsTo(PaymentStatus::class, 'payment_status_id')->withTrashed();
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
