<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable = ['user_name', 'user_id', 'order_ids', 'pdf_url', 'company', 'company_email'];
}
