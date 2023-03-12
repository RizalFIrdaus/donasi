<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class CampaignCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */

    public function __construct(private $message, $collection)
    {
        parent::__construct($collection);
    }

    public function toArray(Request $request): array
    {
        return [
            "status" => true,
            "message" => $this->message,
            "data" => $this->collection
        ];
    }
}
