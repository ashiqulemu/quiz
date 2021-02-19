<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Winner extends Model
{
    protected $fillable = ['id','point','gift','quiz_id','user_id'];
}
