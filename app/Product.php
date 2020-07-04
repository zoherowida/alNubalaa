<?php

namespace App;

use App\Enums\SubCategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Product
 * @package App
 *
 * @property string name
 * @property Category categoryId
 * @property double wholesalePrice
 * @property double sellingPrice
 * @property int subCategory
 * @property int available
 */

class Product extends Model

{
    use SoftDeletes;

    protected $table = 'products';
    protected $fillable = ['name','categoryId', 'price'];

    protected $appends = [
        'subCategoryName',
    ];

    /**
     * Sub Category Name ( مكتبة | شركة )
     * @return int
     */
    public function getSubCategoryNameAttribute(){

        return SubCategory::parse($this->subCategory);

    }

    public function category()
    {
        return $this->belongsTo('App\Category', 'categoryId');
    }


}
