<?php

namespace App\ApiResource;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\Post;
use App\State\OrganizationsShipsProvider;
use App\State\OrganizationsUsersProvider;
use App\State\OrganizationUserRemovingProcessor;

#[ApiResource(operations: [
  new Get(uriTemplate: '/organizations/{id}/ships', provider: OrganizationsShipsProvider::class),
  new Get(uriTemplate: '/organizations/{id}/users', provider: OrganizationsUsersProvider::class),
  new Post(uriTemplate: '/organizations/{id}/users/{userId}', processor: OrganizationUserRemovingProcessor::class),
])]
class Organizations
{
  #[ApiProperty(identifier: true)]
  public int $id;
  // ...
}
