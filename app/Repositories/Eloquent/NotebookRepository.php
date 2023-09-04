<?php

namespace App\Repositories\Eloquent;

use App\Models\Notebooks;
use App\Repositories\NotebookRepositoryInterface;

class NotebookRepository implements NotebookRepositoryInterface
{
    public function getAll()
    {
        return Notebooks::all();
    }

    public function getById(int $id)
    {
        return Notebooks::find($id);
    }

    public function create(array $data): Notebooks
    {
        return Notebooks::create($data);
    }

    public function update(int $id, array $data): Notebooks
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
