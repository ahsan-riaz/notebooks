<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class NoteResource extends ResourceCollection
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return $this->collection->map(function ($note) {
            return [
                'id' => $note->id,
                'notebook_id' => $note->notebook_id,
                'title' => $note->title,
                'content' => $note->content
            ];
        })->all();
    }
}
