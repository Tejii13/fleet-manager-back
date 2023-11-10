<?php

namespace App\State;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProcessorInterface;
use App\ApiResource\Organizations;
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

        if ($organization) {
            $user = $this->userRepository->findOneBy(['id' => $uriVariables['userId']]);

            if ($user) {
                $user->removeOrganization($organization);
                if ($user->getMainOrg() === $organization) {
                    $user->removeMainOrg($organization);
                }

                $this->entityManager->flush();

                return $organization;
            }
        }

        return null;
    }
}
