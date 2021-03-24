<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Technological extends Model
{
    protected $guarded = [];
    //

    public function field(){
        return $this->belongsTo(Field::class);
    }

    public function courses(){
        return $this->hasMany(Course::class);
    }
}
