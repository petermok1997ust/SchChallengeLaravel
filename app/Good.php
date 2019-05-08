<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Good extends Model
{
    protected $table = 'good_storage';
    protected $primaryKey = 'id';
    protected $fillable = ['driver_id', 'description', 'status', 'region_id', 'truck_id', 'weight', 'width', 'height', 'length' ];
}
