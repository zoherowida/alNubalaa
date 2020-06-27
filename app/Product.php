<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model

{
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

        if($this->subCategory === 1) {
            return 'مكتبة' ;
        } else if($this->subCategory === 2){
            return 'شركة' ;
        }

    }

    public function category()
    {
        return $this->belongsTo('App\Category', 'categoryId');
    }


}