<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
  protected $table = 'driver_info';
  protected $primaryKey = 'id';
  protected $fillable = ['first_name', 'last_name', 'identity', 'car_liscene', 'country_of_liscene', 'company', 'phone'];
}
