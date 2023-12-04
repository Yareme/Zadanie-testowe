<?php


namespace App\Controller;

use App\Entity\Rest;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;



class ListaController extends AbstractController
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    /**
     * @Route("/hello", name="hello")
     */
    public function lista(): Response
    {
        $posts = $this->entityManager->getRepository(Rest::class)->findAll();

        return $this->render('lista.html.twig', ["posts" => $posts]);
    }

    #[Route('/delete-post/{id}', name: 'delete_post')]
    #[ParamConverter('post', class: 'App\Entity\Rest')]
    public function deletePost(Rest $post): RedirectResponse
    {
        $this->entityManager->remove($post);
        $this->entityManager->flush();

        return $this->redirectToRoute('lista');
    }
}
