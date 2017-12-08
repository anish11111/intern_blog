<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected  $fillable=['sitename','contact_email','contact_number','address'];

}
