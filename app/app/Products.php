<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name', 'image_url', 'weight'];

    public function stocks()
    {
        return $this->hasMany(Stock::class);
    }
}

