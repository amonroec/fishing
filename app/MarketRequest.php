<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MarketRequest extends Model
{
    protected $fillable = [
    	'user_id',
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
    ];
}
