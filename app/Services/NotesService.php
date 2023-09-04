<?php

namespace App\Services;

use App\Repositories\NotesRepositoryInterface;

class NotesService
{
    protected $repository;

    public function __construct(NotesRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function getAllNotes()
    {
        return $this->repository->getAll();
    }

    public function getNoteById($id)
    {
        return $this->repository->getById($id);
    }

    public function createNote($data)
    {
        return $this->repository->create($data);
    }

    public function updateNote($id, $data)
    {
        return $this->repository->update($id, $data);
    }

    public function deleteNote($id)
    {
        return $this->repository->delete($id);
    }
}
