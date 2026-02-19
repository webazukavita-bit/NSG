<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
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
