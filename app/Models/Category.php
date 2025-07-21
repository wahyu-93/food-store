<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Category extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['image', 'name', 'slug'];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    protected static function boot()
    {
        parent::boot();
    
        // membuat slug sebelum disimpan
        static::saving(function($model){
            if(empty($model->slug)){
                $model->slug = Str::slug($model->name);
            };
        });
    }
}
