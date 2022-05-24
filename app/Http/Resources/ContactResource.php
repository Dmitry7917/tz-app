<?php

namespace App\Http\Resources;

use App\Enums\Gender;
use App\Models\Contact;

/**
 * Class ContactResource
 * @package App\Http\Resources
 * @mixin Contact
 */
class ContactResource extends BaseJsonResource
{
    public function toArray($request): array
    {
        return array_merge(parent::toArray($request), [
            'gender' => $this->whenRequested(
                'gender',
                fn() => Gender::fromValue($this->gender)->toArray()
            ),
            'user' => new UserResource($this->whenLoaded('user')),
        ]);
    }
}
