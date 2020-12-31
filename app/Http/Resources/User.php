<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class User extends JsonResource
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
            'type' => $this->getType(),
            'blocked' => $this->blocked,
            'name' => $this->name,
            'email' => $this->email,
            'photo_url'=>$this->photo_url,
            'deleted_at'=>$this->deleted_at,
        ];
    }

    function getType()
    {
        switch ($this->status){
            case 'C':
                return 'Customer';
            case 'EC':
                return 'Employee-Cook';
            case 'ED':
                return 'Employee-Deliveryman';
            case 'EM':
                return 'Employee-Manager';
        }
    }
}