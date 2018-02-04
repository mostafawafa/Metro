<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Station extends Model
{

    protected $fillable = ['name'];
    public function stations(){

        return $this->belongsToMany(self::class,'stations_relations','station_id','station2_id');
    }
}
