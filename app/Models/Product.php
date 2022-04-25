<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function category ()
    {
        return $this->belongsTo('App\Models\Category');
//        return $this->belongsTo(Category::class);
    }
    public function subcategory ()
    {
        return $this->belongsTo('App\Models\Subcategory');
//        return $this->belongsTo(Category::class);
    }
}
