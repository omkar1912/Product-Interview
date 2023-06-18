<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = ['name','price','category_id','deleted_at','created_by'];

    public function category()
    {
        return $this->belongsTo('App\Models\Category','category_id');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User','created_by');
    }
}
