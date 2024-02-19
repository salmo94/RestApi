<?php

namespace App\Http\Resources;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property int $id
 * @property string $title
 * @property string $content
 * @property string $created_at
 * @property string $published_at
 * @property int $author_id
 * @property-read Comment $comments
 */
class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'content' => $this->content,
            'published_at' => $this->published_at,
            'created_at' => $this->created_at,
            'comments' => $this->collectCommentsTree()
        ];
    }

    private function collectCommentsTree(): array
    {
        $result = [];
        foreach ($this->comments as $comment) {
            $result[] = $this->getChildComments($comment);
        }

        return $result;
    }

    private function getChildComments(Comment $parentComment): array
    {
        $childComments = Comment::where('parent_id', $parentComment->id)->get();
        $children = [];
        foreach ($childComments as $comment) {
            $children[] = $this->getChildComments($comment);
        }
        $childCommentsResult = $parentComment->attributesToArray();
        $childCommentsResult['child_comments'] = $children;

        return $childCommentsResult;
    }
}
