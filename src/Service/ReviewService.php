<?php

namespace App\Service;

use App\DTO\Output\SearchDto;
use App\Repository\ReviewRepository;
use Symfony\Component\HttpFoundation\Request;

final readonly class ReviewService
{
    public function __construct(
        private  ReviewRepository $reviewRepository
    ) {

    }

    public function search(Request $request): SearchDto
    {
        $searchTerm = $request->query->get('q');
        $reviews = [];

        if (null === $searchTerm) {
            return new SearchDto(
                searchTerm: '',
                reviews: $reviews
            );
        }

        if ($searchTerm) {
            $reviews = $this->reviewRepository->searchByCompanyName($searchTerm);
        }

        return new SearchDto(
            searchTerm: $searchTerm,
            reviews: $reviews
        );
    }
}