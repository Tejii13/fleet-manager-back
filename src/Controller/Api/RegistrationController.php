<?php

namespace App\Controller\Api;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Composer\HtppFoundations\Response as JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Passwordhasher\hasher\UserPasswordHasherInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class RegistrationController extends AbstractController
{
  #[Route('/api/register', name: 'app_register', methods: ['POST'])]
  public function registration(UserPasswordHasherInterface $passwordHasher, Request $request, EntityManagerInterface $entityManager): JsonResponse
  {
    try {
      $data = json_decode($request->getContent(), true);

      // Creates the user
      $user = new User();

      // Sets the user data
      $user->setUsername($data['username']);
      $user->setRoles(['roles']);

      $plaintextPassword = $data['password'];

      // Hash the password
      $hashedPassword = $passwordHasher->hashPassword($user, $plaintextPassword);
      $user->setPassword($hashedPassword);

      // Persist in the database
      $entityManager->persist($user);
      $entityManager->flush();

      return JsonResponse(['User created with success'], 201);
    } catch (error) {
      return JsonResponse(['Erreur lors de la connection à la base de données'], 13);
    }
  }
}
