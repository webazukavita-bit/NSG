<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Department extends Model
{
    use SoftDeletes;
    
    protected $table = '_department';
    protected $fillable = [
        'id',
        'name',
        'slug'
    ];
    public function users()
    {
        return $this->hasMany(User::class, 'department_id', 'id');
    }
}
