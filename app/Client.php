<?php

namespace App;

use App\Enums\City;
use App\Enums\SubCategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Client
 * @package App
 *
 * @property string clientName
 * @property string companyName
 * @property int subCategory
 * @property string phoneNumber
 * @property string phoneCompany
 * @property string city
 * @property string location
 * @property string latLong
 */
class Client extends Model

{
    use SoftDeletes;

    protected $table = 'clients';
    protected $fillable = [
        'clientName',
        'companyName',
        'subCategory',
        'phoneNumber',
        'phoneCompany',
        'city',
        'location',
        'latLong',
        'AddBy',
    ];


    protected $appends = [
        'subCategoryName',
        'cityName'
    ];
    /**
     * @var mixed
     */
    private $subCategory;

    /**
     * Sub Category Name ( مكتبة | شركة )
     * @return int
     */

    public function getSubCategoryNameAttribute(){
        if($this->subCategory == null) return '';
        return SubCategory::parse($this->subCategory);
    }
    public function getCityNameAttribute(){
        if($this->city == null) return '';

        return City::parse((int)$this->city);
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'AddBy');
    }

}
