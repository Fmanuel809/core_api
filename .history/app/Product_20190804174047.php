<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Product extends Model implements TranslatableContract
{
    use Translatable;

    public $translatedAttributes = ['name', 'desctiption'];
    protected $fillable = ['url_image', 'is_spent'];

}
