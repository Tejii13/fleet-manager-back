<?php

namespace App\State;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProviderInterface;
use App\Repository\OrganizationsRepository;

class OrganizationsShipsProvider implements ProviderInterface
{
    public function __construct(private OrganizationsRepository $organizationsRepository)
    {
    }
    public function provide(Operation $operation, array $uriVariables = [], array $context = []): object|array|null
    {
        $organization = $this->organizationsRepository->findOneBy(['id' => $uriVariables['id']]);

        $allShips = [];

        foreach ($organization->getUsers() as $user) {
            foreach ($user->getShips() as $ship) {
                $allShips[] = ['name' => $ship->getName(), 'id' => $ship->getId()];
                // $allShips[] = $ship;
            }
        }
        dd($allShips);
    }
}
