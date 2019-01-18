<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = ['name', 'company', 'email_domain', 'pricing_standard', 'pricing_rush', 'pricing_drive_by_1', 'pricing_drive_by_2', 'pricing_drive_by_3', 'pricing_comps_only', 'bill_to_user_id', 'bill_to_user_name', 'bill_to_address', 'bill_to_city', 'bill_to_state', 'bill_to_zip_code'];

}
