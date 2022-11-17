<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Toy extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function subcategory()
    {
        return $this->belongsTo('App\Models\Subcategory', 'subcategory_id');
    }

    public function solds()
    {
        return $this->hasMany('App\Models\SoldToys', 'toy_id');
    }
}
