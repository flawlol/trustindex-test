<?php

namespace App\Controller\Application;

use App\Entity\Review;
use App\Form\ReviewType;
use App\Service\ReviewService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;

class ReviewController extends AbstractController
{
    public function __construct(
        private readonly ReviewService $reviewService,
        private readonly EntityManagerInterface $em,
        private readonly TranslatorInterface $translator,
    ) {
    }

    #[Route('/search', name: 'review_search', methods: ['GET'])]
    public function search(Request $request): Response
    {
        $dto = $this->reviewService->search($request);

        $reviews = $dto->getReviews();
        $searchTerm = $dto->getSearchTerm();

        return $this->render('review/search.html.twig', [
            'reviews' => $reviews,
            'searchTerm' => $searchTerm,
        ]);
    }

    #[Route('/', name: 'review_index', methods: ['GET'])]
    public function index(): Response
    {
        $reviews = $this->em->getRepository(Review::class)->findBy([], ['createdAt' => 'DESC']);

        return $this->render('review/index.html.twig', [
            'reviews' => $reviews,
        ]);
    }

    #[Route('/review/new', name: 'review_new', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        $review = new Review();
        $form = $this->createForm(ReviewType::class, $review);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->persist($review);
            $this->em->flush();

            $this->addFlash('success', $this->translator->trans('review.thanks'));

            return $this->redirectToRoute('review_index');
        }

        return $this->render('review/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/review/{id}', name: 'review_show', methods: ['GET'])]
    public function show(Review $review): Response
    {
        return $this->render('review/show.html.twig', [
            'review' => $review,
        ]);
    }
}
