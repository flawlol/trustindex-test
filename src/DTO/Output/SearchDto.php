<?php

namespace App\DTO\Output;

final readonly class SearchDto
{
    public function __construct(
        public string $searchTerm,
        public array $reviews,
    ) {
    }

    public function getSearchTerm(): string
    {
        return $this->searchTerm;
    }

    public function getReviews(): array
    {
        return $this->reviews;
    }
}
