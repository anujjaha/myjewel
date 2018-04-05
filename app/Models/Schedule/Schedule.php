<?php namespace App\Models\Schedule;

/**
 * Class Schedule
 *
 * @author Anuj Jaha ( er.anujjaha@gmail.com)
 */

use App\Models\BaseModel;
use App\Models\Schedule\Traits\Attribute\Attribute;
use App\Models\Schedule\Traits\Relationship\Relationship;

class Schedule extends BaseModel
{
    use Attribute, Relationship;
    /**
     * Database Table
     *
     */
    protected $table = "data_schedules";

    /**
     * Fillable Database Fields
     *
     */
    protected $fillable = [
        "id", "title", "start_date", "end_date", "address_line_one", "address_line_two", "city", "state", "zip", "status", "created_at", "updated_at", 
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