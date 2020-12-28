<?php

namespace App\Http\Resources;

use App\Models\Order_item;
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
            'customer_id' => $this->customer_id,
            'customer' => new Customer($this->customer),
            'notes' => $this->notes,
            'total_price' => $this->total_price,
            'date' => $this->date,
            'prepared_by'=>$this->prepared_by,
            'delivered_by'=>$this->delivered_by,
            'cook'=> new User($this->cook),
            'opened_at'=>$this->opened_at,
            'closed_at'=>$this->closed_at,
            'current_status_at'=>$this->current_status_at,
            'preparation_time'=>$this->preparation_time,
            'delivery_time'=>$this->delivery_time,
            'total_time'=>$this->total_time,
            'order_items'=>OrderItem::collection($this->order_items)
        ];
    }
}
