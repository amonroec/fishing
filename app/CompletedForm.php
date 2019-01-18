<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CompletedForm extends Model
{
    protected $fillable = ['form_id', 'comp_1', 'comp_2', 'comp_3', 'supporting_docs', 'images', 'estimated_market_value', 'agent'];
    protected $casts = ['comp_1' => 'object', 'comp_2' => 'object', 'comp_3' => 'object', 'agent' => 'object'];
}
