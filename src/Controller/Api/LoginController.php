<?php

namespace App\Controller\Api;

use App\Repository\UserRepository;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
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

    // Verifies if the user exists
    if (!$user) {
      $responseContent = ['message' => "Impossible de s'identifier.", 'code' => 401];
      $statusCode = 401;

      $content = json_encode($responseContent);
      return new JsonResponse($content, $statusCode);
    }

    // Verifies if the password is correct
    if (!$passwordHasher->isPasswordValid($user, $data['password'])) {
      return new JsonResponse(['message' => 'Impossible de s\'identifier.', 'code' => 401], 400);
    }

    // Sends validation response
    return new JsonResponse(['message' => 'Connexion reussie.', 'code' => 201, 'id' => $user->getId()], 200);
  }
}
