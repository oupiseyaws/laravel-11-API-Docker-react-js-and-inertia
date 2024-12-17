<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name','user_id'];

    protected static function booted()
    {
        if(auth()->check()){
            static::addGlobalScope('user_id', function($builder){
                $builder->where('user_id', auth()->id());
            });
        }
    }
}
