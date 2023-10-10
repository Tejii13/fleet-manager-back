<?php

namespace App\State;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProviderInterface;
use App\Repository\OrganizationsRepository;

class OrganizationsUsersProvider implements ProviderInterface
{
    public function __construct(private OrganizationsRepository $organizationsRepository)
    {
    }
    public function provide(Operation $operation, array $uriVariables = [], array $context = []): object|array|null
    {
        $organization = $this->organizationsRepository->findOneBy(['id' => $uriVariables['id']]);

        $allUsers = [];

        foreach ($organization->getUsers() as $user) {
            $allUsers[] = ['username' => $user->getUsername(), 'id' => $user->getId()];
            // $allUsers[] = $user;
        }
        // dd($allUsers);
        return $allUsers;
    }
}
