<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserRequest extends Model 
{

    use SoftDeletes;

    protected $table = 'users_requests';
   
    protected $fillable = [
        'reg_number',
        'name',
        'email',
        'hit_count',
        'verify_at',
        'for',
        'token',
        'phonecode',
        'phone_number',
        'password',
        'role',
        'referral_id',
        'inteducior_id',
        'user_otp',
        'device_id',
        'opt_active',
        'country',
        'state',
        'city',
    ];

    protected $hidden = ['password', 'user_otp'];

}
