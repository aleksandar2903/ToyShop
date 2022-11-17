<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
    use HasFactory;
    protected $guarded = [];


    public function category()
    {
        return $this->belongsTo('App\Models\Category', 'category_id');
    }
    public function toys()
    {
        return $this->hasMany('App\Models\Toy', 'subcategory_id')->withCount('solds')->orderBy('solds_count');
    }
}
