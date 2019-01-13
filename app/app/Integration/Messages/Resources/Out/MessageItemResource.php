<?php

namespace App\Integration\Messages\Resources\Out;

class MessageItemResource
{
    private $item;

    public function __construct(array $item)
    {
        $this->item = $item;
    }

    public function toArray()
    {
        return [
                'cod' => $this->item['code'],
                'remetente'  => [
                                  'nome' => $this->item['sender_name'],
                                  'email'=> $this->item['sender_email'],
                                ],
                'mensagem' => [
                                'assunto' => $this->item['subject'],
                                'html'=> $this->item['body'],
                              ],
                'pasta'=> $this->item['folder'],
            ];
    }
}
