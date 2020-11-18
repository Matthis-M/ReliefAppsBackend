<?php

namespace App\Controller;

use App\Entity\Bookmark;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BookmarksController extends AbstractController
{

    /**
     * @Route("/addBookmark", methods="POST", name="addBookmark")
     */
    public function addBookmark(Request $request): Response
    {
        $entityManager = $this->getDoctrine()->getManager();

        // Fetch the URL of the video from the request's JSON body
        $requestData = json_decode($request->getContent());
        $videoUrl = $requestData->videoUrl;

        // Instanciate a new Entity, set its videoUrl value and send the database query
        $bookmark = new Bookmark();
        $bookmark->setVideoUrl($videoUrl);
        $entityManager->persist($bookmark);
        $entityManager->flush();

        return new Response('Saved new URL with id '.$bookmark->getId());
    }

    /**
     * @Route("/listBookmarks", methods="GET", name="listBookmarks")
     */
    public function getBookmarks(): JsonResponse
    {
        $entityManager = $this->getDoctrine()->getManager();

        // Get the list of all bookmarks stored in the database
        $bookmarksList = $this->getDoctrine()
        ->getRepository(Bookmark::class)
        ->findAll();

        $urlsList = [];

        foreach($bookmarksList as $bookmark) {
            array_push($urlsList, $bookmark->getVideoUrl());
        }

        // Encode the list to send it as a JSON message
        $urlsList = json_encode($urlsList);

        return new JsonResponse($urlsList);
    }
    
}
