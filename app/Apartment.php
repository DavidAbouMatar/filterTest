<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Apartment extends Model
{
    protected $fillable = [
        'name',
        'abbreviation',
        
    ];
    public function expense(){
        return $this->hasone(app\expense::class);
    }
}
