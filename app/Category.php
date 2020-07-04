<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Category
 * @package App
 *
 * @property string name
 * @property int available
 */
class Category extends Model

{
    use SoftDeletes;

    protected $table = 'categories';
    protected $fillable = ['name','subCategory'];

}
