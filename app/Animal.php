<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Animal extends Model
{
    protected $fillable = ['user_id', 'user', 'animal_type', 'weapon', 'size', 'points', 'image', 'team'];
}
