<?php

namespace App\Controller\Api;

use App\Repository\UserRepository;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response as JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class LoginController extends AbstractController
{
  #[Route('/api/login', name: 'app_login', methods: ['POST'])]
  public function login(Request $request, UserRepository $userRepository, UserPasswordHasherInterface $passwordHasher): JsonResponse
  // public function login(Request $request, UserRepository $userRepository): JsonResponse
  {
    $data = json_decode($request->getContent(), true);

    $user = $userRepository->findOneBy(['username' => $data['username']]);

    if (!$user) {
      $responseContent = ['message' => 'Impossible de s\'identifier.', 'code' => 401];
      $statusCode = 401;

      $content = json_encode($responseContent);
      return new JsonResponse($content, $statusCode);
    }

    if (!$passwordHasher->isPasswordValid($user, $data['password'])) {
      $responseContent = ['message' => 'Impossible de s\'identifier.', 'code' => 401];
      $statusCode = 401;

      $content = json_encode($responseContent);
      return new JsonResponse($content, $statusCode);
    }

    $responseContent = ['message' => 'Connexion réussie.', 'code' => 201, 'id' => $user->getId()];
    $statusCode = 200;

    $content = json_encode($responseContent);
    return new JsonResponse($content, $statusCode);
  }
}
