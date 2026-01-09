<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Variation extends Model
{
    use SoftDeletes;
    protected $table = 'variations';

    protected $fillable = [
        'id',
        'parent_id',
        'name',
        'image',
        'description'
    ];
    protected $casts = [
        'updated_at' => 'datetime',
        'created_at' => 'datetime',
    ];
    public function type()
    {
        return $this->belongsTo(Variation::class, 'parent_id');
    }
}
