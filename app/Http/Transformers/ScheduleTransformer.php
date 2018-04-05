<?php
namespace App\Http\Transformers;

use App\Http\Transformers;

class ScheduleTransformer extends Transformer
{
    /**
     * Transform
     *
     * @param array $data
     * @return array
     */
    public function transform($item)
    {
        if(is_array($item))
        {
            $item = (object)$item;
        }

        return [
            "scheduleId" => (int) $item->id, "scheduleTitle" =>  $item->title, "scheduleStartDate" =>  $item->start_date, "scheduleEndDate" =>  $item->end_date, "scheduleAddressLineOne" =>  $item->address_line_one, "scheduleAddressLineTwo" =>  $item->address_line_two, "scheduleCity" =>  $item->city, "scheduleState" =>  $item->state, "scheduleZip" =>  $item->zip, "scheduleStatus" =>  $item->status, "scheduleCreatedAt" =>  $item->created_at, "scheduleUpdatedAt" =>  $item->updated_at, 
        ];
    }

    public function scheduleList($items)
    {
        $response = [];

        if(isset($items) && count($items))
        {
            foreach($items as $item)
            {
                $response[] = [
                    "scheduleId"                => (int) $item->id, 
                    "scheduleTitle"             =>  $item->title, 
                    "scheduleStartDate"         =>  $item->start_date, 
                    "scheduleEndDate"           =>  $item->end_date, 
                    "scheduleAddressLineOne"    =>  $item->address_line_one, 
                    "scheduleAddressLineTwo"    =>  $item->address_line_two, 
                    "scheduleCity"              =>  $item->city, 
                    "scheduleState"             =>  $item->state, 
                    "scheduleZip"               =>  $item->zip, 
                    "scheduleStatus"            =>  $item->status
                ];
            }
        }

        return $response;
    }
}