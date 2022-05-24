<?php

namespace App\Http\Resources;

use App\Models\User;

/**
 * Class UserResource
 * @package App\Http\Resources
 * @mixin User
 */
class UserResource extends BaseJsonResource
{
    public function toArray($request): array
    {
        return array_merge(parent::toArray($request), [
            'contacts' => ContactResource::collection($this->whenLoaded('contacts')),
        ]);
    }
}
