<?php

namespace App\Tests\Service;

use App\Repository\ReviewRepository;
use App\Service\ReviewService;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;

class ReviewServiceTest extends TestCase
{
    public function testSearchWithResults(): void
    {
        // GIVEN
        $searchTerm = 'Test Company';
        $mockedReviews = [
            (object) ['companyName' => 'Test Company', 'rating' => 5, 'reviewText' => 'Great service!'],
        ];

        $reviewRepository = $this->createMock(ReviewRepository::class);
        $reviewRepository
            ->expects($this->once())
            ->method('searchByCompanyName')
            ->with($searchTerm)
            ->willReturn($mockedReviews);

        $service = new ReviewService($reviewRepository);

        $request = new Request(['q' => $searchTerm]);

        // WHEN
        $result = $service->search($request);

        // Then
        $this->assertEquals($searchTerm, $result->searchTerm);
        $this->assertEquals($mockedReviews, $result->reviews);
    }

    public function testSearchWithoutResults(): void
    {
        // GIVEN
        $searchTerm = 'Nonexistent Company';

        $reviewRepository = $this->createMock(ReviewRepository::class);
        $reviewRepository
            ->expects($this->once())
            ->method('searchByCompanyName')
            ->with($searchTerm)
            ->willReturn([]);

        $service = new ReviewService($reviewRepository);

        $request = new Request(['q' => $searchTerm]);

        // WHEN
        $result = $service->search($request);

        // Then
        $this->assertEquals($searchTerm, $result->searchTerm);
        $this->assertEmpty($result->reviews);
    }

    public function testSearchWithEmptyQuery(): void
    {
        // GIVEN
        $reviewRepository = $this->createMock(ReviewRepository::class);
        $reviewRepository
            ->expects($this->never())
            ->method('searchByCompanyName');

        $service = new ReviewService($reviewRepository);

        $request = new Request();

        // WHEN
        $result = $service->search($request);

        // THEN
        $this->assertEquals('', $result->searchTerm);
        $this->assertEmpty($result->reviews);
    }
}
