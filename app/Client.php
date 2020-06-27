<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model

{
    protected $table = 'clients';
    protected $fillable = ['name','subCategory','phoneNumber','city','location','latLong'];

    protected $appends = [
        'subCategoryName'
    ];

    /**
     * Sub Category Name ( مكتبة | شركة )
     * @return int
     */
    public function getSubCategoryNameAttribute(){

        if($this->subCategory === 1) {
            return 'مكتبة' ;
        } else {
            return 'شركة' ;
        }

    }

    public function user()
    {
        return $this->belongsTo('App\User', 'AddBy');
    }

}
