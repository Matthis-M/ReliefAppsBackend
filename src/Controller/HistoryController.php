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
     * @Route("/addHistory", methods="POST", name="addHistory")
     */
    public function addHistory(Request $request): Response
    {
        $entityManager = $this->getDoctrine()->getManager();

        // Fetch the URL of the video from the request's JSON body
        $requestData = json_decode($request->getContent());
        $videoUrl = $requestData->videoUrl;

        // Instanciate a new Entity, set its videoUrl value and send the database query
        $history = new HistoryEntry();
        $history->setVideoUrl($videoUrl);
        $entityManager->persist($history);
        $entityManager->flush();

        return new Response('Saved new URL with id '.$history->getId());
    }

    /**
     * @Route("/listHistory", methods="GET", name="listHistory")
     */
    public function getHistory(): JsonResponse
    {
        $entityManager = $this->getDoctrine()->getManager();

        // Get the complete history stored in the database
        $historyList = $this->getDoctrine()
        ->getRepository(HistoryEntry::class)
        ->findAll();

        $urlsList = [];

        foreach($historyList as $history) {
            array_push($urlsList, $history->getVideoUrl());
        }

        // Encode the list to send it as a JSON message
        $urlsList = json_encode($urlsList);

        return new JsonResponse($urlsList);
    }
    
}
