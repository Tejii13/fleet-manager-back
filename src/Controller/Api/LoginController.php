<?php

namespace App\Controller\Api;

use App\Repository\UserRepository;
// use Symfony\Component\Passwordhasher\hasher\UserPasswordHasherInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response as JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class LoginController extends AbstractController
{
  // public function login(Request $request, UserRepository $userRepository, UserPasswordHasherInterface $passwordHasher): JsonResponse
    #[Route('/api/login', name: 'app_login', methods: ['POST'])]
    public function login(Request $request, UserRepository $userRepository): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $user = $userRepository->findOneBy(['username' => $data['username']]);

        if (!$user) {
          $responseContent = ['message' => 'Utilisateur non trouvé.'];
          $statusCode = 401;

          $content = json_encode($responseContent);
          return new JsonResponse($content, $statusCode);
        }

        // if (passwordHasher->isPasswordValid($user, $data['password'])) {
        //     return new JsonResponse(['message' => 'Mot de passe incorrect.'], 401);
        // }

        // FIXME Temporaty fix
        if ($user->getPassword() !== $data['password']) {
          $responseContent = ['message' => 'Mot de passe incorrect.'];
          $statusCode = 401;

          $content = json_encode($responseContent);
          return new JsonResponse($content, $statusCode);
        }

        $responseContent = ['message' => 'Connexion réussie.'];
        $statusCode = 200;

        $content = json_encode($responseContent);
        return new JsonResponse($content, $statusCode);

    }
}
