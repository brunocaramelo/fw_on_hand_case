<?php

namespace App\Integration\Lists\Resources\In;

class ListItemResource
{
    private $item;

    public function __construct(array $item)
    {
        $this->item = $item;
    }

    public function toArray()
    {
        return [
                'code'=> $this->item['cod'],
                'name' => $this->item['nome'],
                'total'=> $this->item['total'],
                'email'=> $this->item['email'],
                'total_active' => $this->item['total_ativo'],
                'total_inactive' => $this->item['total_inativo'],
              ];
    }
}
