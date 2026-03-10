<?php

namespace App\Controller;

use App\Entity\Post;
use App\Repository\PostRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * Class PostController
 * @package App\Controller
 */
#[Route("/posts")]
Class PostController
{
    /**
     * Undocumented function
     *
     * @param PostRepository $postRepository
     * @param SerializerInterface $serializer
     * @return JsonResponse
     */
    #[Route(name: "api_posts_collection_get", methods: ['GET'])]
    public function colleciton(PostRepository $postRepository, SerializerInterface $serializer): JsonResponse
    {
        return new JsonResponse(
            $serializer->serialize($postRepository->findAll(), "json", ['groups' => 'get']),
            JsonResponse::HTTP_OK,
            [],
            true
        );
    }

    /**
     * Undocumented function
     *
     * @param Post $post
     * @param SerializerInterface $serializer
     * @return JsonResponse
     */
    #[Route("/{id}", name: "api_posts_item_get", methods: ['GET'])]
    public function item(Post $post, SerializerInterface $serializer): JsonResponse
    {
        return new JsonResponse(
            $serializer->serialize($post, "json", ['groups' => 'get']),
            JsonResponse::HTTP_OK,
            [],
            true
        );
    }

    /**
     * Undocumented function
     *
     * @param Request $request
     * @param SerializerInterface $serializer
     * @param EntityManagerInterface $entityManager
     * @param UrlGeneratorInterface $urlGenerator
     * @return JsonResponse
     */
    #[Route(name: "api_posts_collection_post", methods: ['POST'])]
    public function post(
        Request $request,
        SerializerInterface $serializer,
        EntityManagerInterface $entityManager,
        UrlGeneratorInterface $urlGenerator
    ): JsonResponse {
        /** @var Post $post */
        $post = $serializer->deserialize($request->getContent(), Post::class, 'json');
        $entityManager->persist($post);
        $entityManager->flush();
        return new JsonResponse(
            $serializer->serialize($post, "json", ['groups' => 'get']),
            JsonResponse::HTTP_CREATED,
            ["Location" => $urlGenerator->generate('api_posts_item_get', ['id' => $post->getId()])],
            true
        );
    }

    /**
     * Undocumented function
     *
     * @param Post $post
     * @param Request $request
     * @param SerializerInterface $serializer
     * @param EntityManagerInterface $entityManager
     * @return JsonResponse
     */
    #[Route("/{id}", name: "api_posts_collection_put", methods: ['PUT'])]
    public function put(
        Post $post,
        Request $request,
        SerializerInterface $serializer,
        EntityManagerInterface $entityManager
    ): JsonResponse {
        $serializer->deserialize(
            $request->getContent(),
            Post::class,
            'json',
            [AbstractNormalizer::OBJECT_TO_POPULATE => $post]
        );
        $entityManager->flush();
        return new JsonResponse(null, JsonResponse::HTTP_NO_CONTENT);
    }

    /**
     * Undocumented function
     *
     * @param Post $post
     * @param EntityManagerInterface $entityManager
     * @return JsonResponse
     */
    #[Route("/{id}", name: "api_posts_collection_delete", methods: ['DELETE'])]
    public function delete(
        Post $post,
        EntityManagerInterface $entityManager
    ): JsonResponse {
        $entityManager->remove($post);
        $entityManager->flush();
        return new JsonResponse(null, JsonResponse::HTTP_NO_CONTENT);
    }
}