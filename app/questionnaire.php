<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class questionnaire extends Model
{
    use SoftDeletes;

    protected $table = 'questionnaires';
    protected $fillable = ['name','productId', 'price','clientId','discount'];


    public function product()
    {
        return $this->belongsTo(Product::class, 'productId');
    }

    public function client()
    {
        return $this->belongsTo(Client::class, 'clientId');
    }

}
