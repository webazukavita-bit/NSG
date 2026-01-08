<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductVariation extends Model
{
    // use SoftDeletes;
    protected $table = 'product_variations';

    protected $fillable = [
        'id',
        'product_id',
        'variation_type_id',
        'variation_value_id',
    ];
    protected $casts = [
        'updated_at' => 'datetime',
        'created_at' => 'datetime',
    ];
    
    public function variationType()
{
    return $this->belongsTo(Variation::class, 'variation_type_id');
}

public function variationValue()
{
    return $this->belongsTo(Variation::class, 'variation_value_id');
}
      public function allValues()
    {
        return $this->hasMany(Variation::class, 'parent_id', 'variation_type_id');
    }
}
