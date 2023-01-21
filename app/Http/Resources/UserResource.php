<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $roles = $this->getRoleNames();
        $role = $roles[0];
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'role_name' => $role,
        ];
    }
}
