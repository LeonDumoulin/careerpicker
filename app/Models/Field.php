<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Field extends Model
{
    //
    protected $guarded = [];

       public function department()
{
    return $this->belongsTo(Department::class);
}
public function technologicals(){
           return $this->hasMany(Technological::class);
}

}
