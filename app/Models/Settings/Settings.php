<?php namespace App\Models\Settings;

/**
 * Class Settings
 *
 * @author Anuj Jaha ( er.anujjaha@gmail.com)
 */

use App\Models\BaseModel;
use App\Models\Settings\Traits\Attribute\Attribute;
use App\Models\Settings\Traits\Relationship\Relationship;

class Settings extends BaseModel
{
    use Attribute, Relationship;
    /**
     * Database Table
     *
     */
    protected $table = "data_settings";

    /**
     * Fillable Database Fields
     *
     */
    protected $fillable = [
        "id", "title", "data_key", "value", "status", "created_at", "updated_at", 
    ];

    /**
     * Timestamp flag
     *
     */
    public $timestamps = true;

    /**
     * Guarded ID Column
     *
     */
    protected $guarded = ["id"];
}