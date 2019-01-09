<?php

namespace App\Integration\Results\Resources\In;

class ResultItemResource
{
    private $item;

    public function __construct(array $item)
    {
        $this->item = $item;
    }

    public function toArray()
    {
        return [
                'code_message'   => $this->item['id_mensagem'],
                'open_messages' => $this->item['qtde_abertura'],
                'unique_open_messages'=> $this->item['qtde_abertura_unico'],
                'click_quantity'=> $this->item['qtde_clique'],
                'want_on'=> $this->item['qtde_encaminhado'],
                'quantity_canceled' => $this->item['qtde_cancelado'],
                'quantity_returned' => $this->item['qtde_devolvido'],
                'quantity_delivered' => $this->item['qtde_entregue'],
                'return_delivery_time' => $this->item['ret_tempo_entrega'],
                'return_pattern' => $this->item['ret_padrao'],
                'birth_day' => $this->item['data_nascimento'],
                'total_time' => $this->item['tempo_total'],
                'quantity_scheduled' => $this->item['qtde_agendado'],
                'quantity_sent' => $this->item['qtde_enviado'],
                'quantity_widthout_interaction' => $this->item['qtde_sem_interacao'],
            ];
    }
}