<?php

namespace App\Repositories;

use App\DTOs\BookDTO;

interface BookRepositoryInterface {
    public function getAll(): array;
    public function find($id): BookDTO;
    public function create(BookDTO $data): BookDTO;
    public function update($id, BookDTO $data): BookDTO;
    public function delete($id): bool;
}
