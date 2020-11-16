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
     * @Route("/bookmarks", methods="POST", name="addBookmark")
     */
    public function addBookmark(Request $request): Response
    {
        $requestData = json_decode($request->getContent());
        $videoUrl = $requestData->test;

        $entityManager = $this->getDoctrine()->getManager();

        //TODO Url validation

        $bookmark = new Bookmark();
        $bookmark->setVideoUrl($videoUrl);

        $entityManager->persist($bookmark);
        $entityManager->flush();

        return new Response('Saved new URL with id '.$bookmark->getId());
    }

    /**
     * @Route("/bookmarks", methods="GET", name="listBookmarks")
     */
    public function getBookmarks(): JsonResponse
    {
        $entityManager = $this->getDoctrine()->getManager();

        $bookmarksList = $this->getDoctrine()
        ->getRepository(Bookmark::class)
        ->findAll();

        $urlsList = [];

        foreach($bookmarksList as $bookmark) {
            array_push($urlsList, $bookmark->getVideoUrl());
        }

        $urlsList = json_encode($urlsList);

        return new JsonResponse($urlsList);
    }
    
}
