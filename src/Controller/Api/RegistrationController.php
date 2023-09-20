<?php

namespace App\Controller\Api;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response as JsonResponse;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Uid\Uuid;
use Symfony\Component\Uid\UuidV4;
use \DateTime;

class RegistrationController extends AbstractController
{
  #[Route('/api/register', name: 'app_register', methods: ['POST'])]
  public function registration(
    UserPasswordHasherInterface $passwordHasher,
    Request $request,
    EntityManagerInterface $entityManager,
    UserRepository $userRepository): JsonResponse
  {
    try {
      $data = json_decode($request->getContent(), true);

      // Check ig the user already exists
      $existingUser = $userRepository->findOneBy(['username' => $data['username']]);

      if ($existingUser !== null) {

        $responseContent = ['message' => 'Cet utilisateur existe déjà', 'code' => 400];
        $statusCode = 400;
        $content = json_encode($responseContent);
        return new JsonResponse($content, $statusCode);
      }

      // Creates the user
      $user = new User();

      // Sets the user data
      $user->setUsername($data['username']);
      $user->setRoles($data['roles']);

      $creationDate = new \DateTime();
      $plaintextPassword = $data['username'] . '.' . $creationDate->format('Y-m-d') . '.' . 'temporaire';

      // Hashes the password
      $hashedPassword = $passwordHasher->hashPassword($user, $plaintextPassword);
      $user->setPassword($hashedPassword);

      // Generates auth uuid
      $auth = Uuid::v4();
      $user->setAuth($auth);

      // Sets expire date
      $expireDate = new \DateTime();
      $expireDate->modify('+1 month');
      $user->setAuthExpiresAt($expireDate);

      // Sets verification status
      $user->setVerified(false);

      // Persists in the database
      $entityManager->persist($user);
      $entityManager->flush();

      // Sends validation response
      $responseContent = ['message' => 'Utilisateur créé avec succès.', 'code' => 201, 'pass' => $plaintextPassword];
      $statusCode = 201;

      $content = json_encode($responseContent);
      return new JsonResponse($content, $statusCode);
    } catch (\Exception $e) {
      $responseContent = ['message' => 'L\'opération a échoué.', 'code' => 400];
      $statusCode = 400;

      $content = json_encode($responseContent);
      return new JsonResponse($content, $statusCode);
    }
  }
}
