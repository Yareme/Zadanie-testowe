<?php
namespace App\Controller;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Entity\Rest;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @ApiResource()
 */

class PostApiController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/posts', name: 'api_posts', methods: ['GET'])]
    public function getPosts(): JsonResponse
    {
        $posts = $this->entityManager->getRepository(Rest::class)->findAll();

        return $this->json($posts,  200, [],['json_encode_options' => JSON_PRETTY_PRINT]);
    }
}