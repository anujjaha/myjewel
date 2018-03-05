<?php namespace App\Models\Content;

/**
 * Class Content
 *
 * @author Anuj Jaha 
 */

use App\Models\BaseModel;
use App\Models\Content\Traits\Attribute\Attribute;

class Content extends BaseModel
{
    use Attribute;

    /**
     * Database Table
     *
     */
    protected $table = "data_contents";

    /**
     * Fillable Database Fields
     *
     */
    protected $fillable = [
        'data_key',
        'title',
        'content',
        'status'
    ];

    /**
     * Guarded ID Column
     *
     */
    protected $guarded = ["id"];
}