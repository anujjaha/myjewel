<?php namespace App\Models\LoginBanner;

/**
 * Class LoginBanner
 *
 * @author Anuj Jaha 
 */

use App\Models\BaseModel;
use App\Models\LoginBanner\Traits\Attribute\Attribute;
//use App\Models\Event\Traits\Attribute\Attribute;
use App\Models\Event\Traits\Relationship\Relationship;

class LoginBanner extends BaseModel
{
    use Attribute, Relationship;

    /**
     * Database Table
     *
     */
    protected $table = "data_login_banners";

    /**
     * Fillable Database Fields
     *
     */
    protected $fillable = [
        'title',
        'sub_title',
        'image',
        'email_id',
        'contact_number',
        'status',
    ];

    /**
     * Guarded ID Column
     *
     */
    protected $guarded = ["id"];
}