<?php

namespace App\Controller\Api;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Uid\Uuid;
use Symfony\Component\Uid\UuidV4;



class LoginController extends AbstractController
{
  #[Route('/api/login', name: 'app_login', methods: ['POST'])]
  public function login(EntityManagerInterface $entityManager, Request $request, UserRepository $userRepository, UserPasswordHasherInterface $passwordHasher): JsonResponse
  // public function login(Request $request, UserRepository $userRepository): JsonResponse
  {
    $data = json_decode($request->getContent(), true);

    $user = $userRepository->findOneBy(['username' => $data['username']]);

    // Verifies if the user exists
    if (!$user) {
      $responseContent = ['message' => "Impossible de s'identifier. duh", 'code' => 401];
      $statusCode = 401;

      $content = json_encode($responseContent);
      return new JsonResponse($content, $statusCode);
    }

    // Verifies if the password is correct
    if (!$passwordHasher->isPasswordValid($user, $data['password'])) {
      return new JsonResponse(['message' => 'Impossible de s\'identifier.', 'code' => 401], 400);
    }

    // Generates auth uuid
    $auth = Uuid::v4();
    $user->setAuth($auth);

    // Sets expire date
    $expireDate = new \DateTime();
    $expireDate->modify('+1 month');
    $user->setAuthExpiresAt($expireDate);

    // Persist user
    $entityManager->persist($user);
    $entityManager->flush();

    // Sends validation response
    return new JsonResponse(['message'=>'Connexion réussie.','auth'=>$auth,'code'=>201,'id'=>$user->getId()], 200);
  }

  #[Route('/api/verify', name: 'app_verify', methods: ['PUT'])]
  public function verifyConnection(Request $request, UserRepository $userRepository): JsonResponse
  {
    $data = json_decode($request->getContent(), true);

    $user = $userRepository->findOneBy(['id' => $data['id']]);

    // Verifies if the user exists
    if (!$user) {
      return new JsonResponse(['message'=>'This user doesn\'t exist', 'code'=>401], 401);
    }
    
    if ($data['auth'] !== $user->getAuth()) {
      return new JsonResponse(['message'=>'Need to reconnect', 'code'=>401], 401);
    }
    
    return new JsonResponse(['message'=>'Connection verified', 'code'=>200],200);
  }
}
