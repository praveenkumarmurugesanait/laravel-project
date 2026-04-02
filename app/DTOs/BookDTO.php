<?php

namespace App\DTOs;

class BookDTO
{
    public string $title;
    public string $author;
    public ?int $publishedYear; // allow null

    public function __construct(string $title, string $author, ?int $publishedYear = null)
    {
        $this->title = $title;
        $this->author = $author;
        $this->publishedYear = $publishedYear;
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['title'],
            $data['author'],
            $data['published_year'] ?? null
        );
    }

    public function toArray(): array
    {
        return [
            'title'          => $this->title,
            'author'         => $this->author,
            'published_year' => $this->publishedYear,
        ];
    }
}
