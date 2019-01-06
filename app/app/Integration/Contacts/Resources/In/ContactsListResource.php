<?php

namespace App\Integration\Contacts\Resources\In;

use App\Integration\Contacts\Resources\In\ContactsItemResource;

class ContactsListResource
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
            $resource = new ContactsItemResource($itemList);
            $result[] = $resource->toArray();
        }
        return $result;
    }
}