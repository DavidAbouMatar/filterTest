<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    protected $fillable = [
        'payment_period',
        'currency',
        'item',
        'listing_id',
    ];
    public function expense(){
        return $this->belongsTo(app\Apartment::class);
    }
}
