<?php

namespace App\Controller;

use App\Entity\HistoryEntry;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HistoryController extends AbstractController
{

    /**
     * @Route("/history", methods="POST", name="addHistory")
     */
    public function addHistory(Request $request): Response
    {
        $requestData = json_decode($request->getContent());
        $videoUrl = $requestData->videoUrl;

        $entityManager = $this->getDoctrine()->getManager();

        //TODO Url validation

        $history = new HistoryEntry();
        $history->setVideoUrl($videoUrl);

        $entityManager->persist($history);
        $entityManager->flush();

        return new Response('Saved new URL with id '.$history->getId());
    }

    /**
     * @Route("/history", methods="GET", name="listHistory")
     */
    public function getHistory(): JsonResponse
    {
        $entityManager = $this->getDoctrine()->getManager();

        $historyList = $this->getDoctrine()
        ->getRepository(HistoryEntry::class)
        ->findAll();

        $urlsList = [];

        foreach($historyList as $history) {
            array_push($urlsList, $history->getVideoUrl());
        }

        $urlsList = json_encode($urlsList);

        return new JsonResponse($urlsList);
    }
    
}
