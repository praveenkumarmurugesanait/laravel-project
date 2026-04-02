<?php

namespace App\Repositories;

use App\Models\Book;
use App\DTOs\BookDTO;

class BookRepository implements BookRepositoryInterface
{
    public function getAll(): array
    {
        return Book::all()->map(fn($book) => 
            new BookDTO($book->title, $book->author, $book->published_year)
        )->toArray();
    }

    public function find($id): BookDTO
    {
        $book = Book::findOrFail($id);
        return new BookDTO($book->title, $book->author, $book->published_year);
    }

    public function create(BookDTO $data): BookDTO
    {
        $book = Book::create($data->toArray());
        return new BookDTO($book->title, $book->author, $book->published_year);
    }

    public function update($id, BookDTO $data): BookDTO
    {
        $book = Book::findOrFail($id);
        $book->update($data->toArray());
        return new BookDTO($book->title, $book->author, $book->published_year);
    }

    public function delete($id): bool
    {
        $book = Book::findOrFail($id);
        return $book->delete();
    }
}
