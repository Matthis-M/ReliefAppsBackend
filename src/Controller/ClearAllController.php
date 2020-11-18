<?php

namespace App\Controller;

use App\Entity\HistoryEntry;
use App\Entity\Bookmark;
use Doctrine\DBAL\Connection;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ClearAllController extends AbstractController
{
    /**
     * @Route("/clearall", name="clear_all")
     */
    public function clearAll(): Response
    {
        $entityManager = $this->getDoctrine()->getManager();

        $query = $entityManager->createQuery(
            'DELETE FROM App\Entity\Bookmark WHERE 1=1'
        )->execute();

        $query = $entityManager->createQuery(
            'DELETE FROM App\Entity\HistoryEntry WHERE 1=1'
        )->execute();

        return new Response('Tables cleared');
    }
}
