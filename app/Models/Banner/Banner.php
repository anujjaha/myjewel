<?php namespace App\Models\Banner;

/**
 * Class Banner
 *
 * @author Anuj Jaha
 */

use App\Models\BaseModel;
use App\Models\Banner\Traits\Attribute\Attribute;
use App\Models\Banner\Traits\Relationship\Relationship;

class Banner extends BaseModel
{
    use Attribute, Relationship;
    /**
     * Database Table
     *
     */
    protected $table = "data_feature_banners";

    /**
     * Fillable Database Fields
     *
     */
    protected $fillable = [
        'title',
        'sub_title',
        'image',
        'status'
    ];

    /**
     * Guarded ID Column
     *
     */
    protected $guarded = ["id"];
}