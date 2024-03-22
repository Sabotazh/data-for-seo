<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property int $id
 * @property mixed target_domain
 * @property mixed referring_domain
 * @property mixed excluded_target
 * @property mixed rank
 * @property mixed backlinks
 * @property mixed created_at
 * @property mixed updated_at
 */
class DataforseoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        if (is_null($this->target_domain)) return [];

        return [
            'id' => $this->id,
            'target_domain' => $this->target_domain,
            'referring_domain' => json_decode($this->referring_domain),
            'excluded_target' => is_null($this->excluded_target) ? [] : json_decode($this->excluded_target),
            'rank' => json_decode($this->rank),
            'backlinks' => json_decode($this->backlinks),
            'created_at' => Carbon::parse($this->created_at)->toDateTimeString(),
            'updated_at' => Carbon::parse($this->updated_at)->toDateTimeString()

        ];
    }
}
