<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class MovieResourceV1 extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request)
    {
        return [
            "name" => $this->name,
            "casts" => json_decode($this->casts),
            "release_date" => date("d-m-Y", strtotime($this->release_date)),
            "director" => $this->director,
            "ratings" => [
                "imdb" => number_format($this->imdb_rating, 2),
                "rotten_tomatoes" => number_format($this->rotten_tomatoes_rating, 2)
            ]
        ];
    }
}
