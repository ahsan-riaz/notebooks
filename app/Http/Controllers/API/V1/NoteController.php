<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\NoteRequest;
use App\Http\Resources\NoteResource;
use App\Services\NotesService;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class NoteController extends Controller
{
    private $noteService;
    public function __construct(NotesService $noteService) 
    {
        $this->noteService = $noteService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->noteService->getAllNotes();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(NoteRequest $request)
    {
        dd($request);
        try {
            $validatedData = $request->validated();
            $note = $this->noteService->createNote($validatedData);

            return response()->json($note, 201);
        } catch (ValidationException $e) {
            Log::error('Validation error while creating a note: ' . $e->getMessage());
            return response()->json(['error' => 'Validation error'], 400);
        } catch (\Exception $e) {
            Log::error('Error while creating a note: ' . $e->getMessage());
            return response()->json(['error' => 'Server error'. $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        try {
            $note =  $this->noteService->getNoteById($id);

            return new NoteResource($note);
        } catch (\Exception $e) {
            Log::error('Error while fetching note: ' . $e->getMessage());
            return response()->json(['error' => 'Note not found'], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(NoteRequest $request, int $id)
    {
        try {
            $validatedData = $request->validated();
            $note = $this->noteService->updateNote($id, $validatedData);

            return response()->json($note);
        } catch (ValidationException $e) {
            Log::error('Validation error while updating note: ' . $e->getMessage());
            return response()->json(['error' => 'Validation error'], 400);
        } catch (\Exception $e) {
            Log::error('Error while updating note: ' . $e->getMessage());
            return response()->json(['error' => 'Server error'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        try {
            $note = $this->noteService->deleteNote($id);

            return response()->json(['message' => 'Note deleted successfully']);
        } catch (\Exception $e) {
            Log::error('Error while deleting note: ' . $e->getMessage());
            return response()->json(['error' => 'Server error'], 500);
        }
    }
}
