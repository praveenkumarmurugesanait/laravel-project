<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\BookRepositoryInterface;
use App\DTOs\BookDTO;

class BookController extends Controller
{
    protected $bookRepository;

    public function __construct(BookRepositoryInterface $bookRepository)
    {
        $this->bookRepository = $bookRepository;
    }

    // GET /books
    public function index()
    {
        $books = $this->bookRepository->getAll();
        // $books is an array of BookDTOs → convert each to array
        $response = array_map(fn($bookDTO) => $bookDTO->toArray(), $books);
        return response()->json($response);
    }

    // POST /books
    public function store(Request $request)
    {
        $bookDTO = BookDTO::fromArray($request->all());
        $book = $this->bookRepository->create($bookDTO);
        return response()->json($book->toArray(), 201);
    }

    // GET /books/{id}
    public function show($id)
    {
        $book = $this->bookRepository->find($id);
        return response()->json($book->toArray());
    }

    // PUT /books/{id}
    public function update(Request $request, $id)
    {
        $bookDTO = BookDTO::fromArray($request->all());
        $book = $this->bookRepository->update($id, $bookDTO);
        return response()->json($book->toArray());
    }

    // DELETE /books/{id}
    public function destroy($id)
    {
        $this->bookRepository->delete($id);
        return response()->json(null, 204);
    }
}
