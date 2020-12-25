<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Order extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'status' => $this->status,
            'notes' => $this->notes,
            'total_price' => $this->total_price,
            'date' => $this->date,
            'prepared_by'=>$this->prepared_by,
            'delivered_by'=>$this->delivered_by,
            'opened_at'=>$this->opened_at,
            'closed_at'=>$this->closed_at,
            'current_status_at'=>$this->current_status_at,
            'preparation_time'=>$this->preparation_time,
            'delivery_time'=>$this->delivery_time,
            'total_time'=>$this->total_time,
        ];
    }
}
