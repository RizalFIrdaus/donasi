<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CampaignJson extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */

    public function __construct(private $message, $json)
    {
        parent::__construct($json);
    }
    public function toArray(Request $request): array
    {
        return [
            "status" => true,
            "message" => $this->message,
            "data" => $this->resource,
        ];
    }
}
