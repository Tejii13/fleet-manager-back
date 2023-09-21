<?php

namespace App\Controller\Api;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;

use App\Service\RandomIdGenerator;

class UpdateAccountController extends AbstractController
{
    #[Route('/api/update/password', name: 'app_update_account', methods: ['PUT'])]
    public function updatePassword(UserPasswordHasherInterface $passwordHasher, UserRepository $userRepository, Request $request, EntityManagerInterface $entityManagerInterface): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $user = $userRepository->findOneBy(['id' => $data['id']]);

        if (!$user) {
            return new JsonResponse(['message' => "Impossible de s'identifier", 'code' => 401], 401);
        }

        $password = $data('password');
        $hashedPassword = $passwordHasher->hashPassword($user, $password);

        $user->setPassword($hashedPassword);

        return new JsonResponse(['message' => 'Password changed!', 'code' => 201], 201);
    }

    #[Route('/api/randomId', name: 'app_randomId', methods: ['PUT'])]
    public function getRandomId(Request $request, RandomIdGenerator $idGenerator): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $randomId = $idGenerator->generateRandomId($data['userId']);

        return new JsonResponse(['id' => $randomId, 'code' => 201], 201);
    }
}
