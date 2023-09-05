<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\NotebookRequest;
use App\Http\Resources\NoteBookResource;
use App\Services\NotebookService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class NotebookController extends Controller
{
    private $notebookService;
    public function __construct(NotebookService $notebookService) 
    {
        $this->notebookService = $notebookService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return new NoteBookResource($this->notebookService->getAllNotebooks());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(NotebookRequest $request)
    {
        try {
            $validatedData = $request->validated();
            $notebook = $this->notebookService->createNotebook($validatedData);

            return response()->json($notebook, 201);
        } catch (ValidationException $e) {
            Log::error('Validation error while creating a notebook: ' . $e->getMessage());
            return response()->json(['error' => 'Validation error'], 400);
        } catch (\Exception $e) {
            Log::error('Error while creating a notebook: ' . $e->getMessage());
            return response()->json(['error' => 'Server error'. $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        try {
            $notebook =  $this->notebookService->getNotebookById($id);
            return new NoteBookResource($notebook);
        } catch (\Exception $e) {
            Log::error('Error while fetching notebook: ' . $e->getMessage());
            return response()->json(['error' => 'Notebook not found'], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(NotebookRequest $request, int $id)
    {
        try {
            $validatedData = $request->validated();
            $notebook = $this->notebookService->updateNotebook($id, $validatedData);

            return response()->json($notebook);
        } catch (ValidationException $e) {
            Log::error('Validation error while updating notebook: ' . $e->getMessage());
            return response()->json(['error' => 'Validation error'], 400);
        } catch (\Exception $e) {
            Log::error('Error while updating notebook: ' . $e->getMessage());
            return response()->json(['error' => 'Server error'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        try {
            $notebook = $this->notebookService->deleteNotebook($id);

            return response()->json(['message' => 'Notebook deleted successfully']);
        } catch (\Exception $e) {
            Log::error('Error while deleting notebook: ' . $e->getMessage());
            return response()->json(['error' => 'Server error'], 500);
        }
    }
    
    public function getNoteBooksByUser(Request $request)
    {
        // Get the authenticated user from the token
        $user = $request->user();

        if (!$user) {
            return response()->json(['error' => 'User not authenticated'], 401);
        }

        $notes = $user->notes;

        return new NoteBookResource($notes);
    }

}
