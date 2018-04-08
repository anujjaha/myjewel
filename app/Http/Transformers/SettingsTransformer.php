<?php
namespace App\Http\Transformers;

use App\Http\Transformers;

class SettingsTransformer extends Transformer
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
            "settingsId" => (int) $item->id, "settingsTitle" =>  $item->title, "settingsKey" =>  $item->key, "settingsValue" =>  $item->value, "settingsStatus" =>  $item->status, "settingsCreatedAt" =>  $item->created_at, "settingsUpdatedAt" =>  $item->updated_at, 
        ];
    }

    /**
     * Get Setting
     * 
     * @param object $item
     * @return array
     */
    public function getSetting($key = 'setting', $item = null)
    {
        $response = [];

        if(isset($item))
        {
            $response = [
                'dataKey'   =>  $key,
                'dataValue' =>  $item
            ];
        }

        return $response;
    }
}