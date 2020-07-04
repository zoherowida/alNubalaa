<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Questionnaire
 * @package App
 *
 * @property string name
 * @property int productId
 * @property string price
 * @property string clientId
 * @property string discount
 * @property string productName
 */

class questionnaire extends Model
{
    use SoftDeletes;

    protected $table = 'questionnaires';
    protected $fillable = ['name','productId', 'price','clientId','discount'];

    protected $appends = [
        'productName',
    ];

    public function getProductNameAttribute(){

        $name = Product::withTrashed()->find($this->productId);
        if($name){
            return $name->name;

        } else {
            return 'N/Y';
        }

    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'productId');
    }

    public function client()
    {
        return $this->belongsTo(Client::class, 'clientId');
    }

}
