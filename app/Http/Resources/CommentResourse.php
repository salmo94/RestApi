<?php

namespace App\Http\Resources;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property string $text
 * @property string $created_at
 * @property-read User $author
 */
class CommentResourse extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'author_login' => $this->author->login,
            'text' => $this->text,
            'created_at' => $this->created_at
        ];
    }
}
