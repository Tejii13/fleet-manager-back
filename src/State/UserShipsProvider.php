<?php

namespace App\State;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProviderInterface;
use App\Repository\ShipRepository;

class UserShipsProvider implements ProviderInterface
{
    public function __construct(private ShipRepository $shipRepository)
    {
    }
    public function provide(Operation $operation, array $uriVariables = [], array $context = []): object|array|null
    {
        $shipsList = $this->shipRepository->findBy(['owner' => $uriVariables['id']]);

        return $shipsList;
    }
}
