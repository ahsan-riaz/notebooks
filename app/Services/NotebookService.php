<?php

namespace App\Services;

use App\Repositories\NotebookRepositoryInterface;

class NotebookService
{
    protected $repository;

    public function __construct(NotebookRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function getAllNotebooks()
    {
        return $this->repository->getAll();
    }

    public function getNotebookById($id)
    {
        return $this->repository->getById($id);
    }

    public function createNotebook($data)
    {
        return $this->repository->create($data);
    }

    public function updateNotebook($id, $data)
    {
        return $this->repository->update($id, $data);
    }

    public function deleteNotebook($id)
    {
        return $this->repository->delete($id);
    }
}
