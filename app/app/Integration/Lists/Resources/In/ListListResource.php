<?php

namespace App\Integration\Lists\Resources\In;

use App\Integration\Lists\Resources\In\ListItemResource;

class ListListResource
{
    private $list;

    public function __construct(array $list)
    {
        $this->list = $list;
    }

    public function toArray()
    {
        $result = [];
        foreach ($this->list as $itemList) {
            $resource = new ListItemResource($itemList);
            $result[] = $resource->toArray();
        }
        return $result;
    }
}
