<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function toys()
    {
        return $this->hasMany('App\Models\SoldToys');
    }
    public function users()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }
}
