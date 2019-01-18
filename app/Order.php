<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
    	'user_id',
    	'user_name',
    	'user_email',
			'forms',
			'status',
			'price',
			'full_name',
			'company',
			'email',
			'address',
			'city',
			'state',
			'zip_code',
			'payment_status',
			'token',
			'stripe_charge',
    ];
    protected $casts = ['forms' => 'array'];
}
