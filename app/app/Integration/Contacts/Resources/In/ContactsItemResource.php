<?php

namespace App\Integration\Contacts\Resources\In;

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
                'code'   => $this->item['cod'],
                'name' => $this->item['nome'],
                'free1'=> $this->item['livre1'],
                'free2'=> $this->item['livre2'],
                'email'=> $this->item['email'],
                'neighborhood' => $this->item['bairro'],
                'office' => $this->item['cargo'],
                'cellphone' => $this->item['celular'],
                'cep' => $this->item['cep'],
                'city' => $this->item['cidade'],
                'birth_day' => $this->item['data_nascimento'],
                'company' => $this->item['empresa'],
                'address' => $this->item['endereco'],
                'state' => $this->item['estado'],
                'fax' => $this->item['fax'],
                'observation' => $this->item['observacao'],
                'country' => $this->item['pais'],
                'branch_activity' => $this->item['ramo_atividade'],
                'genre' => $this->item['sexo'],
                'commercial_phone' => $this->item['tel_comercial'],
                'phone' => $this->item['telefone'],
            ];
    }
}
