<?php

namespace App\State;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProcessorInterface;
use App\Repository\OrganizationsRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;

class OrganizationUserRemovingProcessor implements ProcessorInterface
{
    public function __construct(private OrganizationsRepository $organizationsRepository, private UserRepository $userRepository, private EntityManagerInterface $entityManager)
    {
        // dd('Bonjour!');
    }
    public function process(mixed $data, Operation $operation, array $uriVariables = [], array $context = []): mixed
    {

        $organization = $this->organizationsRepository->findOneBy(['id' => $uriVariables['id']]);
        $user = $this->userRepository->findOneBy(['id' => $uriVariables['userId']]);

        $organization->removeUser($user);
        // $user->removeOrganization($organization);

        // $this->entityManager->persist($user);
        $this->entityManager->persist($organization);
        $this->entityManager->flush();

        // dump($organization);
        // dd($user);
        return $organization;
    }
}
