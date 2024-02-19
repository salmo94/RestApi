<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property string $login
 * @property string $email
 * @property string $profile_image_path
 */
class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'login' => $this->login,
            'email' => $this->email,
            'profile_image_path' => $this->profile_image_path
        ];
    }
}
