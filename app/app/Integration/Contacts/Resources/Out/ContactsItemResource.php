<?php

namespace App\Integration\Contacts\Resources\Out;

class ContactsItemResource
{
    private $item;

    public function __construct(array $item)
    {
        $this->item = $item;
    }

    public function toArray()
    {
        return [
                'cod'  => $this->item['code'],
                'nome' => $this->item['name'],
                'email'=> $this->item['email'],
                'livre1' => $this->item['free1'],
                'livre2'=> $this->item['free2'],
                'uidcli'=> $this->item['uidcli'],
                ];
    }
}
