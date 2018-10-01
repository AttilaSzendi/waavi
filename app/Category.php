<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use \Waavi\Translation\Traits\Translatable;

    protected $translatableAttributes = ['name'];

    protected $fillable = ['name'];
}
