<?php

namespace App\Repositories\Eloquent;

use App\Models\Notes;
use App\Repositories\NotesRepositoryInterface;

class NotesRepository implements NotesRepositoryInterface
{
    public function getAll()
    {
        return Notes::all();
    }

    public function getById(int $id)
    {
        return Notes::find($id);
    }

    public function create(array $data): Notes
    {
        return Notes::create($data);
    }

    public function update(int $id, array $data): Notes
    {
        $notebook = $this->getById($id);
        $notebook->update($data);
        return $notebook;
    }

    public function delete(int $id): bool
    {
        $notebook = $this->getById($id);
        $notebook->delete();
        return true;
    }
}
