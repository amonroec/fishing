<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Form extends Model
{
    protected $fillable = [
    	'user_id',
    	'user_name',
    	'user_email',
		'form_type',
		'turnaround',
		'county',
		'property_owner',
		'property_address',
		'parcel_id',
		'city',
		'state',
		'zip',
		'zoning',
		'bedrooms',
		'bathrooms',
		'square_feet',
		'lot_size',
		'basement',
		'year_built',
		'condition',
		'pricing',
		'additional_comments',
		'status',
		'comp_1',
		'comp_2',
		'comp_3',
		'supporting_docs',
		'images',
		'estimated_market_value',
		'agent',
		'rejected_reason'
    ];

    protected $casts = ['comp_1' => 'object', 'comp_2' => 'object', 'comp_3' => 'object', 'agent' => 'object'];
}
