<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class NoteBookResource extends ResourceCollection
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return $this->collection->map(function ($notebook) {
            return [
                'id' => $notebook->id,
                'user_id' => $notebook->user_id,
                'title' => $notebook->title,
                'description' => $notebook->description
            ];
        })->all();
    }
}
