<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IncomingShipment extends Model
{
    protected $fillable = ['store_id', 'product_id', 'scheduled_date', 'quantity', 'weight'];

    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
