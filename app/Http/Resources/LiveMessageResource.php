<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LiveMessageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return array(
            'title'=>$this->title,
            'relationTitle'=>$this->relation_title,
            'content'=>$this->content,
            'date'=>$this->created_at->format('Y-m-d H:i:s'),
        );
    }
}
