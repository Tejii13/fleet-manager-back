<?php

namespace App\Controller\Api;

use App\Entity\User;
use App\Entity\Organizations;
use App\Repository\OrganizationsRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response as JsonResponse;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Uid\Uuid;
use App\Service\RandomIdGenerator;


class RegistrationController extends AbstractController
{
  #[Route('/api/register', name: 'app_register', methods: ['POST'])]
  public function registration(
    UserPasswordHasherInterface $passwordHasher,
    Request $request,
    EntityManagerInterface $entityManager,
    UserRepository $userRepository,
    OrganizationsRepository $organizationsRepository,
    RandomIdGenerator $idGenerator,
  ): JsonResponse {
    try {
      $data = json_decode($request->getContent(), true);

      $organization = new Organizations();
      $organization = $organizationsRepository->findOneBy(['id' => $data['organizationId']]);

      // Check ig the user already exists
      $existingUser = $userRepository->findOneBy(['username' => $data['username']]);

      if ($existingUser !== null) {

        //Add user to organization
        if ($organization) {
          $existingUser->addOrganization($organization);
          $entityManager->persist($organization);
        } else {
          $responseContent = ['message' => 'Impossible to find the given organization.', 'code' => 400];
          $statusCode = 400;

          $content = json_encode($responseContent);
          return new JsonResponse($content, $statusCode);
        }

        $entityManager->persist($existingUser);
        $entityManager->flush();

        // Sends validation response
        $responseContent = ['message' => 'User added to the organization.', 'code' => 201];
        $statusCode = 201;
        $content = json_encode($responseContent);
        return new JsonResponse($content, $statusCode);
      } else {
        // Creates the user
        $user = new User();

        // Sets the user data
        $user->setUsername($data['username']);
        $user->setRoles($data['roles']);

        $plaintextPassword = $data['username'] . '.' . $idGenerator->generateRandomId(10);

        // Hashes the password
        $hashedPassword = $passwordHasher->hashPassword($user, $plaintextPassword);
        $user->setPassword($hashedPassword);

        // Generates auth uuid
        // $auth = Uuid::v4();
        // $user->setAuth($auth);
        $auth = Uuid::v4();
        $user->setAuth($auth);

        // Sets verification status
        $user->setVerified(false);

        //Add user to organization
        $organization = new Organizations();
        $organization = $organizationsRepository->findOneBy(['id' => $data['organizationId']]);

        if ($organization) {
          $user->addOrganization($organization);
          $entityManager->persist($organization);
        } else {
          $responseContent = ['message' => 'Impossible to find given organization.', 'code' => 400];
          $statusCode = 400;

          $content = json_encode($responseContent);
          return new JsonResponse($content, $statusCode);
        }

        // Persists in the database
        $entityManager->persist($user);
        $entityManager->flush();

        // Sends validation response
        $responseContent = ['message' => 'User created.', 'code' => 201, 'pass' => $plaintextPassword];
        $statusCode = 201;

        $content = json_encode($responseContent);
        return new JsonResponse($content, $statusCode);
      }
    } catch (\Exception $e) {
      $responseContent = ['message' => 'Operation failed.', 'error' => $e, 'code' => 400];
      $statusCode = 400;

      $content = json_encode($responseContent);
      return new JsonResponse($content, $statusCode);
    }
  }

  public function addUserToOrg($organizationsRepository, $data, $user, $entityManager)
  {
  }
}
