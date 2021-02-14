<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Discussion extends JsonResource {
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request) {
        return [
            'id'            => $this->id,
            'title'         => $this->title,
            'description'   => $this->description,
            'body'          => $this->body,
            'topic'         => $this->whenLoaded('topic'),
            'user'          => $this->whenLoaded('user'),
            'type'          => $this->whenLoaded('type'),
            'created_at'    => $this->created_at,
            'updated_at'    => $this->updated_at,
        ];
    }
}
